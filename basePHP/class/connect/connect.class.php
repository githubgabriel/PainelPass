<?php

class conexao {

    static $con; /* Variavel de Conexao */
    static $re; /* Variavel de Resultado */

    function __construct() {

    }

    static function connect() {
        self::$con = new mysqli(mysql_host, mysql_user, mysql_pass, mysql_database);
        if(mysqli_connect_errno()){
            die('Sem Conexao MYSQL [' .mysqli_connect_error(). ']');
        }
    }

    static function query($sql) {
        self::$re = mysqli_query(self::$con, $sql) or die (mysqli_error(self::$con));
		return self::$re;
    }

    static function num_rows($i = null) {
		if(isset($i)) {
			return mysqli_num_rows($i);
		} else {
			return mysqli_num_rows(self::$re);
		}
    }

    static function fetch_array($i = null) {
		if(isset($i)) {
			return mysqli_fetch_array($i);
		} else {
			return mysqli_fetch_array(self::$re);
		}
       
    }

    static function fetch_object($i = null) {
        if(isset($i)) {
            return mysqli_fetch_object($i);
        } else {
            return mysqli_fetch_object(self::$re);
        }

    }

}

?>