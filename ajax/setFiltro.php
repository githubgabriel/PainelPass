<?
session_start();

if($_POST["id"]) {

    if($_POST["id"] == "categoria") {
        $_SESSION["filtro_categoria"] = $_POST["valor"];
    }

    if($_POST["id"] == "tipo") {
        $_SESSION["filtro_tipo"] = $_POST["valor"];
    }

    if($_POST["id"] == "string") {
        $_SESSION["filtro_string"] = $_POST["valor"];
    }

}

?>