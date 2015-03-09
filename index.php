<?
    require_once("basePHP/config.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>KeyPass</title>
    <link href="css/layout.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery-1.11.1.min.js"></script>
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

            <?=painelPass::getTable();?>

        </tbody>

    </table>

</div> <!-- end conteudo -->

<script src="js/script.js"></script>

</body>
</html>