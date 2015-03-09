<?php
/*
    @author Gabriel A. Barbosa
    @email tx.gabrielbarbosa@gmail.com
    @desc Funcoes para Mysql
    @version 1.0.0
    @update 11/FEV/2015
*/

class MysqlTools {

    /*
        Pega total de Registros de uma tabela.. definindo where e order
    */
    public function get_total_num_regitros($tabela,$where,$order) {
        $sql = "select * from ".$tabela." ".$where." ".$order;
        conexao::query($sql);
        if(conexao::num_rows() > 0) {
            return conexao::num_rows();
        } else {
            return "0";
        }
    }
    public function get_fetch_array_registro($tabela,$where) {
        $sql = "select * from ".$tabela." ".$where." ";
        conexao::query($sql);
        if(conexao::num_rows() > 0) {
            return conexao::fetch_array();
        } else {
            return "0";
        }
    }
    /*
        Update Coluna Valor
    */
    public function set_coluna_valor($tabela,$coluna,$novovalor,$where) {
        $sql = "update ".$tabela." set $coluna = '$novovalor' ".$where." ";
        conexao::query($sql);
        $re = mysqli_affected_rows(conexao::$con);
        if($re) { return "1"; }
        else { return "0"; }
    }



    /* Functions */
	public function mysql_fast_connect($user,$pass,$host,$db) {
		if(!empty($user) and
		   !empty($host) and
		   !empty($db)) {
			mysql_connect($host,$user,$pass) or die (mysql_error());
			mysql_select_db($db) or die (mysql_error());
		} else {
			echo "Falta Dados para conex�o MYSQL FAST";
		}
	}




}



?>