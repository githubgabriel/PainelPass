<?php
/*
    @author Gabriel A. Barbosa
    @email tx.gabrielbarbosa@gmail.com
    @desc Funcoes Diversos PHP
    @version 1.0.0
    @update 11/FEV/2015
*/
class php {

	/* VARS */
	var $MicroTime_Start, $MicroTime_End; /* f: (start_Microtime(), end_Microtime(), get_Microtime()) */

    /* Variavel que grava diretorio especificado de upload */
	var $UploadDir = "./basePHP/uploads/"; /* f: create_folder_upload() && delete_folder_upload() */

    public function set_header($tipo = 0) {
        if($tipo == 0) {
            header('Content-type: text/html; charset=ISO-8859-1');
        } else {
            header('Content-type: text/html; charset=UTF-8');
        }
    }
    public function redirecionar($link) {
        echo "<script> document.location.href='".$link."'; </script>";
    }



    /* ----------------------------------------------------------------------------------
	 *
	 *
	 *
	 *      ________ UPLOAD ________
	 *
	 *
	 *
	 *
	 * ---------------------------------------------------------------------------------- */
    public function get_random_timename() {

        $val1 = rand(10000000,99999999);
        $val2 = time();
        $name = $val1.$val2;
        return $name;

    }
    public function upload_file($arrayr_file, $dir, $extensionvalidas) {

        $fileName = $arrayr_file["name"];
        $fileTmpLoc = $arrayr_file["tmp_name"];

        /* Pega somente extensao do arquivo */
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $ext = strtolower($ext);

        /* Gera novo Nome para arquivo */
        $newname = self::get_random_timename().".".$ext;

        // Monta url local aonde arquivo será salvo
        $pathAndName = $dir.$newname;

            /* Verifica se extensao é valida */
            $allowed = explode(",",$extensionvalidas);
            if(in_array($ext,$allowed) )
            {
                $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);

                if ($moveResult == true) {
                    chmod($pathAndName, 0777);
                    return $newname;
                } else {
                    return false;
                }
            } else {
                return false;
            }
    }
    /* ----------------------------------------------------------------------------------
     *
     *
     *
     *      ________ Manipula��o Diretorios ________
     *
     *
     *
     *
     * ---------------------------------------------------------------------------------- */
	public function create_folder_upload($nomeFolder) {
		if(!empty($nomeFolder)) { 
			$folderPath = $this->UploadDir.$nomeFolder;
			if(!is_dir($folderPath)) {
				mkdir($folderPath) or die("create_folder_upload: Erro ao criar diret�rio");
				chmod($folderPath, 0777);
			}
		} else { echo " create_folder_upload: N�o � possivel criar pasta sem nome. "; }
	}
	public function delete_folder_upload($caminhoFolder) {
		if(!empty($caminhoFolder)) { 
			$folderPath = $this->UploadDir.$caminhoFolder;
			$rootDir = $folderPath;
			if (is_dir($rootDir))
			{
				if (!preg_match("/\\/$/", $rootDir))
				{
        		$rootDir .= '/';
				}
				$stack = array($rootDir);
				while (count($stack) > 0)
				{
        		$hasDir = false;
        		$dir    = end($stack);
        		$dh     = opendir($dir);
        		while (($file = readdir($dh)) !== false)
        		{
            		if ($file == '.'  ||  $file == '..')
            		{
              		  continue;
            		}

            		if (is_dir($dir . $file))
            		{
						$hasDir = true;
                		array_push($stack, $dir . $file . '/');
					}

					else if (is_file($dir . $file))
					{
						unlink($dir . $file);
					}
				}
				closedir($dh);
        		if ($hasDir == false)
				{
            		array_pop($stack);
            		rmdir($dir);
				}
				}
			}
		} else { echo " delete_folder_upload: N�o � possivel deletar pasta sem nome. "; }
	}
	
	public function create_folder($nomeFolder) {
		if(!empty($nomeFolder)) { 
			$folderPath = $nomeFolder;
			if(!is_dir($folderPath)) {
				mkdir($folderPath) or die("create_folder: Erro ao criar diret�rio");
				chmod($folderPath, 0777);
			}
		} else { echo " create_folder: N�o � possivel criar pasta sem nome. "; }
	}
	public function delete_folder($caminhoFolder) {
		if(!empty($caminhoFolder)) { 
			$folderPath = $caminhoFolder;
			$rootDir = $folderPath;
			if (is_dir($rootDir))
			{
				if (!preg_match("/\\/$/", $rootDir))
				{
        		$rootDir .= '/';
				}
				$stack = array($rootDir);
				while (count($stack) > 0)
				{
        		$hasDir = false;
        		$dir    = end($stack);
        		$dh     = opendir($dir);
        		while (($file = readdir($dh)) !== false)
        		{
            		if ($file == '.'  ||  $file == '..')
            		{
              		  continue;
            		}

            		if (is_dir($dir . $file))
            		{
						$hasDir = true;
                		array_push($stack, $dir . $file . '/');
					}

					else if (is_file($dir . $file))
					{
						unlink($dir . $file);
					}
				}
				closedir($dh);
        		if ($hasDir == false)
				{
            		array_pop($stack);
            		rmdir($dir);
				}
				}
			}
		} else { echo " delete_folder: N�o � possivel deletar pasta sem caminho. "; }
	}
	
	/* ----------------------------------------------------------------------------------
	 *
	 *
	 *
	 *      ________ Hora, Data, TimeZone ________
	 *		
	 *
	 *
	 * 
	 * ---------------------------------------------------------------------------------- */
    public function convert_datetime_to_mysql($recebedata) {
        $god = explode(" ", $recebedata);

        $data = $god[0];
        $hora = $god[1];

        $data_ex = explode("/",$data);
        $data_new = $data_ex[2]."-".$data_ex[1]."-".$data_ex[0];

        $final = $data_new." ".$hora;

        return $final;

    }

    public function convert_datetime_to_brasil($recebedata) {
        $god = explode(" ", $recebedata);

        $data = $god[0];
        $hora = $god[1];

        $data_ex = explode("-",$data);
        $data_new = $data_ex[2]."/".$data_ex[1]."/".$data_ex[0];

        $final = $data_new." ".$hora;

        return $final;

    }

    public function datahora_format($recebedata) {
        if($recebedata) {
        $god = explode(" ", $recebedata);
        $data = $god[0];
        $hora = $god[1];
        $data_ex = explode("-",$data);
        $data_new = $data_ex[2]."/".$data_ex[1]."/".$data_ex[0];
        $final[0] = $data_new;
        $final[1] = substr($hora,0,-3);
        return $final;
        } else {
            return "";
        }
    }

    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    public function get_Ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

	public function	start_Microtime() {
		$this->MicroTime_Start = microtime(true);
	}
	public function	end_Microtime() {
		$this->MicroTime_End = microtime(true);
	}
	public function	get_Microtime() {
		if(!empty($this->MicroTime_Start) or !empty($this->MicroTime_End)) {
			$resultado = ($this->MicroTime_End - $this->MicroTime_Start );
			
			$saida =  round( (($resultado)*1000), 2);
			
			return $saida;
		} else { return "MicroTime sem variavel"; }
	}
	public function	set_TimeZone($zone) {
		if(!empty($zone)) {
			date_default_timezone_set($zone);
		} else { echo "Set Timezone sem valor !"; }
	}
	public function get_Horario($tipo) {
		switch ($tipo) { 
			case 0:
				$sttr = "H:i:s";	
			break;
			case 1:
				$sttr ="H:i";	
			break;
			default:
				$sttr = "H:i:s";
			break;
		}
		$hora = date($sttr);
		return $hora;
	}

    public function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }

    public function getDiasEntreDatas($time_inicial,$time_final) {
        $time_inicial = self::geraTimestamp($time_inicial);
        $time_final = self::geraTimestamp($time_final);
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
        return $dias;
    }


    public function get_Hora() {
		$hora = $this->get_Horario();
		$exhora = explode(":",$hora);
		return $exhora[0];
	}
	public function get_Minuto() {
		$hora = $this->get_Horario();
		$exhora = explode(":",$hora);
		return $exhora[1];
	}
	public function get_Segundo() {
		$hora = $this->get_Horario();
		$exhora = explode(":",$hora);
		return $exhora[2];
	}
	public function get_DateTime() {
		$hora = self::get_Horario();
		$data = self::get_Data("mysql");
		$datetime = $data." ".$hora;
		return $datetime;
	}public function get_DateTime2() {
		$hora = self::get_Horario();
		$data = self::get_Data("nomysql");
		$datetime = $data." ".$hora;
		return $datetime;
	}
	public function get_Data($tipo = "nomysql") {
		switch ($tipo) { 
			case "nomysql":
				$sttr = "d/m/Y";	
			break;
			case "mysql":
				$sttr = "Y-m-d";	
			break;
			default:
				$sttr = "d/m/Y";
			break;
		}
		$data = date($sttr);
		return $data;
	} /* end get_Data */
	public function get_Ano() {
		$data = $this->get_Data();
		$exdata = explode("/",$data);
		return $exdata[2];
	}
	public function get_Mes() {
		$data = $this->get_Data();
		$exdata = explode("/",$data);
		return $exdata[1];
	} 
	public function get_Dia() {
		$data = $this->get_Data();
		$exdata = explode("/",$data);
		return $exdata[0];
	}
	public function get_DiaSemana() {
		$data = date("w");
		return $data;
	}
	public function get_Mes_String($mes_int) {
		switch ($mes_int) {
			case "01":    $mes = "Janeiro";     break;
			case "02":    $mes = "Fevereiro";   break;
			case "03":    $mes = "Mar�o";       break;
			case "04":    $mes = "Abril";       break;
			case "05":    $mes = "Maio";        break;
			case "06":    $mes = "Junho";       break;
			case "07":    $mes = "Julho";       break;
			case "08":    $mes = "Agosto";      break;
			case "09":    $mes = "Setembro";    break;
			case "10":    $mes = "Outubro";     break;
			case "11":    $mes = "Novembro";    break;
			case "12":    $mes = "Dezembro";    break;
			default:    $mes = "Valor N�o Existe";    break; 
		}
		return $mes;
	}/* end get_Mes_String */

    public function get_Mes_String2($mes_int) {
        switch ($mes_int) {
            case "01":    $mes = "Jan";     break;
            case "02":    $mes = "Fev";   break;
            case "03":    $mes = "Mar";       break;
            case "04":    $mes = "Abr";       break;
            case "05":    $mes = "Mai";        break;
            case "06":    $mes = "Jun";       break;
            case "07":    $mes = "Jul";       break;
            case "08":    $mes = "Ago";      break;
            case "09":    $mes = "Set";    break;
            case "10":    $mes = "Out";     break;
            case "11":    $mes = "Nov";    break;
            case "12":    $mes = "Dez";    break;
            default:    $mes = "Valor Não Existe";    break;
        }
        return $mes;
    }/* end get_Mes_String */
	public function get_DiaSemana_string($diaSemana_int) {
		switch($diaSemana_int){  
			case"0": $diasemana = "Domingo";	   break;  
			case"1": $diasemana = "Segunda-Feira"; break;  
			case"2": $diasemana = "Terça-Feira";   break;
			case"3": $diasemana = "Quarta-Feira";  break;  
			case"4": $diasemana = "Quinta-Feira";  break;  
			case"5": $diasemana = "Sexta-Feira";   break;
			case"6": $diasemana = "Sábado";		break;
			default:    $mes = "Valor Não Existe";    break;
		}
		return $diasemana;
	}
}

?>