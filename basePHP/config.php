<?php
/*
 *
 * @author Gabriel Azuaga Barbosa
 * @email tx.gabrielbarbosa@gmail.com
 * @version 2.0.0
 *
 */

session_start();


/********************************************* DEFINE ***********************************************/
/*
    Inicia Definicoes
*/
require "define.php";




/********************************************* CONNECT ***********************************************/
/*
    INICIA CLASSE STATIC CONEXAO MYSQLI (BANCO DE DADOS)
*/
require "class/connect/connect.class.php";
conexao::connect();




/********************************************* CLASS ***********************************************/
/*
    INICIA CLASSE COM FUNCOES ESSENCIAIS DO PHP
*/
require "class/php.class.php";
//php::set_header(1); /* Forçar Header UTF8 :D */
php::set_TimeZone('America/Campo_Grande');

/*
    INICIA CLASSE COM FUNCOES ESPECIAIS GABRIEL
*/
require "class/mysqltools.class.php";
//$mysqltools = new MysqlTools();


/*
    INICIA CLASSE COM FUNCOES ESPECIAIS GABRIEL
*/
//require "class/log.class.php";
//$log = new log();


/********************************************* SUBCLASS ***********************************************/
/*
    INICIA CLASSE MANIPULACAO DE IMAGENS
*/
//require "class/subclass/canvas.php";




/********************************************* SYSTEM ***********************************************/
/*
    Inicia Classe voltada para Sistema Admin
*/
//require "class/systems/admin.class.php";
//$admin = new Admin();


/* Inicia classes voltada para SITE/FRONT */
//require "class/front/curriculo.class.php";
require "class/front/painelpass.class.php";

?>