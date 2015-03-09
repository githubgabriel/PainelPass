<?php

class Admin {

    var $table_usuario = "admin_usuarios";
    var $table_variaveis = "admin_variavel";
    var $table_menu = "admin_menu";
    var $log;

    function __construct() {
        $this->log = new log();
    }

    /* ===============================================================================================================
            -------------------------------------- AUTENTICACAO LOGIN ----------------------------------------------
    =================================================================================================================*/
    
	/* Monta lista do menu do file sidebar :D */
	public function show_menu_dinamic($modulo) {

        /* Verifica qual é o menu e submenu selected ... */
        $_SESSION["menu_page"] = "";
        if (empty($_GET["p"])) {
            $_SESSION["menu_page"] = "lista";
        } else { $_SESSION["menu_page"] = $_GET["p"]; }

        if (isset($_GET["mi"])) {
            $_SESSION["menu_index"] = base64_decode($_GET["mi"]);
        }

        /* ------ */


			$sql = "select * from ".$this->table_menu." where pai_id = '0' and status = '1' order by ordem asc";
            $re = conexao::query($sql);
			$num = conexao::num_rows($re);
            if($num) {
				$texto = "";
				for($i=0;$i<$num;$i++) {
					$aw = conexao::fetch_array($re);
					$aw["modulo_name"] = explode(",",$aw["modulo_name"]);
					
					if(in_array($modulo, $aw["modulo_name"])) { $add = 'class="current"'; } else { $add = $modulo; }
					
					$texto .= "<li $add >";
					$texto .= '<a href="'.$aw["link"].'" target="'.$aw["target"].'">
									<i class="'.$aw["icon"].'"></i>
									'.($aw["nome"]).'
								</a>';
						
						$sql2 = "select * from ".$this->table_menu." where pai_id = '".$aw["id"]."' and status = '1' order by ordem asc";
						$re2 = conexao::query($sql2);
						$num2 = conexao::num_rows($re2);
						if($num2) {	
							$texto .= "<ul class='sub-menu'>";
								for($i2=0;$i2<$num2;$i2++) {
									$aw2 = conexao::fetch_array($re2);
									
									$aw2["link"] = str_replace("[MYID]",base64_encode($_SESSION["admin_id"]),$aw2["link"]);
									
									//$aw2["modulo_name"] = explode(",",$aw2["modulo_name"]);
									//if(in_array($menupage, $aw2["modulo_name"])) { $add = 'class="current"'; } else { $add = ""; }

									
										if($_SESSION["menu_index"] == $aw2["id"]) { 
											$add = 'class="current"'; 
										} else { $add = "";  }
										
									
									
									$texto .= "<li $add >";
									$texto .= '<a href="'.$aw2["link"].'&mi='.base64_encode($aw2["id"]).'" target="'.$aw2["target"].'">
												<i class="icon-angle-right"></i>
												'.($aw2["nome"]).'
												</a>';
									$texto .= "</li>";
								}
							$texto .= "</ul>";
						}
						
					$texto .= "</li>";
				}
				return $texto;
			}
	}
	
	/*
        verifica se usuario esta logado para entrar na pagina
        senao redireciona para login.php
    */
    public function admin_checa_logado() {
        $user_itoken = $this->user_get_coluna_valor("itoken");
        $session_itoken = $_SESSION["admin_itoken"];
        if($session_itoken != $user_itoken) {
            $this->admin_login(false);
            php::redirecionar("login.php");
        }
    }

    /*
        funcao para autenticar email e senha
        e retornar 0 ou 1
    */
    public function admin_autenticar_login($email,$senha) {
        if(!empty($email) and !empty($senha)) {
            $sql = "select * from ".$this->table_usuario." where email = '".$email."' and senha = '".$senha."' and status = '1'";
            conexao::query($sql);
            if(conexao::num_rows() > 0) {
                $aw = conexao::fetch_array();


                $hora = php::get_Horario(1);
                $navegador = php::getBrowser();
                $ip = php::get_Ip();
                /* log */
                $this->log->insertLog("autenticacao","icon-user","","Usuário <b>".$aw["nome_completo"]."</b> fez login ás (<b>".$hora."</b>) - (Browser: ".$navegador["name"].", Sistema: ".$navegador["platform"].", IP: ".$ip.")");

                /* Cria Sessions de usuario */
                $_SESSION["admin_id"] = $aw["id"];
                $_SESSION["admin_level"] = $aw["level"];
                /* Seta autenticacao como true */
                $this->admin_login(true);
                echo "1";
            } else {

                $hora = php::get_Horario(1);
                $navegador = php::getBrowser();
                $ip = php::get_Ip();
                /* log */
                $this->log->insertLog("autenticacao","icon-user","red","Tentativa de conexão como: <b>".$email."</b> ás (<b>".$hora."</b>) - (Browser: ".$navegador["name"].", Sistema: ".$navegador["platform"].", IP: ".$ip.")");



                echo "0";
            }
        } else {
            echo "0";
        }
    }
    /*
        Seta sessao de login
    */
    public function admin_login($boola = false) {
        if($boola) {
            $_SESSION["admin_itoken"] = base64_encode(time());
            $_SESSION["admin_login"] = 1;
            $this->user_update_coluna_valor("itoken",$_SESSION["admin_itoken"]);
        } else {
            session_destroy();
        }
    }




    /* ============================================================================================================================ */

    /*

                USUARIOS FUNCTIONS

    */

    /*
        Update coluna tabela usuarios
    */
    public function user_update_coluna_valor($coluna,$novovalor) {
        $id_user = $_SESSION["admin_id"];
        $sql = "update ".$this->table_usuario." set $coluna = '".$novovalor."' where id = '".$id_user."'";
        conexao::query($sql);

    }

    /*
      Get valor da coluna tabela usuarios
    */
    public function user_get_coluna_valor($coluna) {
        $sql = "select $coluna from ".$this->table_usuario." where id = '".$_SESSION["admin_id"]."'";
        conexao::query($sql);
        if(conexao::num_rows()) {
            $aw = conexao::fetch_array();
            return $aw[$coluna];
        } else {
            return "0";
        }
    }


    /* Mostra nome */
    public function usuario_get_nome() {
        $nome = $this->user_get_coluna_valor("nome_completo");
        if(empty($nome)) { $nome = "Usuário"; }
        echo $nome;
    }


    /* ============================================================================================================================ */





    /*
        Retorna valor dinamico de variaveis da tabela variaveis admin
    */
    public function get_Variavel($identificador) {
        $sql = "select valor from ".$this->table_variaveis." where identificador = '".$identificador."'";
        conexao::query($sql);
        if(conexao::num_rows()) {
            $aw = conexao::fetch_array();
            return $aw["valor"];
        } else {
            return false;
        }

    }

    public function set_Variavel($identificador,$novovalor) {
        $sql = "update ".$this->table_variaveis." set valor = '$novovalor' where identificador = '".$identificador."'";
        conexao::query($sql);
        if(conexao::num_rows()) {
            $aw = conexao::fetch_array();
            return $aw["valor"];
        } else {
            return false;
        }

    }



}


?>