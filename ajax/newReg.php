<?php

require_once("../basePHP/config.php");

    painelPass::$categoria = $_POST["novo_categoria"];
    painelPass::$tipo = $_POST["novo_tipo"];
    painelPass::$descricao = $_POST["novo_descricao"];
    painelPass::$website = $_POST["novo_website"];
    painelPass::$url = $_POST["novo_url"];
    painelPass::$login = $_POST["novo_login"];
    painelPass::$senha = $_POST["novo_senha"];


echo painelPass::save();
