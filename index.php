<?
    require_once("basePHP/config.php");

    if($_GET["senha"] == "senha1313") { $_SESSION["LoGGED"] = 1; }
    if(!isset($_SESSION["LoGGED"])) { echo "FUCK THE SYSTEM ~ Password ?"; die(); }

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>KeyPass</title>
    <link href="css/layout.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>

<div id="conteudo">

    <div id="filtro">
        <b> Categoria </b>
        <select name="filtro_categoria">
            <?=painelPass::getInputSelect("categoria", $_SESSION["filtro_categoria"]);?>
        </select>
    </div>

    <div id="filtro">
        <b> Tipo </b>
        <select name="filtro_tipo">
            <?=painelPass::getInputSelect("tipo", $_SESSION["filtro_tipo"]);?>
        </select>
    </div>


    <div id="filtro">
        <b> Filtro Texto </b>
        <input type="text" style='padding:5px;' name="filtro_string" value="<?=$_SESSION["filtro_string"];?>" />

    </div>

</div>

<div id="novoregistro">

    <div id="element" class="fL">

        <b> Categoria </b>
        <input type="text" style='padding:5px;' name="novo_categoria" value="" />

    </div>
    <div id="element" class="fL">

        <b> Tipo </b>
        <input type="text" style='padding:5px;' name="novo_tipo" value="" />

    </div>
    <div id="element">

        <b> Website </b>
        <input type="text" style='padding:5px;' name="novo_website" value="" />

    </div>
    <div class="clear"> </div>
    <div id="element" class="fL">

        <b> URL </b>
        <input type="text" style='padding:5px;' name="novo_url" value="" />

    </div>
    <div id="element" class="fL">

        <b> LOGIN </b>
        <input type="text" style='padding:5px;' name="novo_login" value="" />

    </div>
    <div id="element" class="fL">

        <b> SENHA </b>
        <input type="text" style='padding:5px;' name="novo_senha" value="" />

    </div>
    <div class="clear"> </div>
    <div id="element" class="fL">

        <b> Descrição </b>
        <input type="text" style='padding:5px;width:400px;' name="novo_descricao" value="" />

    </div>
    <div id="element" class="fL">
        <input type="button" id="btn_registrar" class="btn" value="Registrar">
        <input type="button" id="btn_cancelar" class="btn" value="Cancelar">
    </div>
    <div class="clear"> </div>

</div>

<input type="button" id="btn_criarnovo" class="btn" value="Novo Registro">


<div id="conteudo">

    <table border="0" id="registros">
        <thead>
            <tr>
                <td width="15"> ID </td>
                <td width="90"> Categoria </td>
                <td width="90"> Tipo </td>
                <td width="220"> Website </td>
                <td width="220"> URL </td>
                <td width="150"> Login </td>
                <td width="150"> Senha </td>
                <td> Descrição </td>
            </tr>
        </thead>

        <tbody>


        </tbody>

    </table>

</div> <!-- end conteudo -->

<script> updateTable(); </script>

</body>
</html>