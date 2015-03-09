<?
    require_once("basePHP/config.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>KeyPass</title>
    <link href="css/layout.css" type="text/css" rel="stylesheet" />
</head>
<body>



<div id="conteudo">

    <table border="0" id="registros">
        <thead>
            <tr>
                <td> ID </td>
                <td> Categoria </td>
                <td> Tipo </td>
                <td> Website </td>
                <td> URL </td>
                <td> Login </td>
                <td> Senha </td>
                <td> Descrição </td>
            </tr>
        </thead>

        <tbody>

            <?=painelPass::getTable();?>

        </tbody>

    </table>

</div> <!-- end conteudo -->

</body>
</html>