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
                <td width="20"> ID </td>
                <td width="90"> Categoria </td>
                <td width="90"> Tipo </td>
                <td width="180"> Website </td>
                <td width="180"> URL </td>
                <td width="180"> Login </td>
                <td width="180"> Senha </td>
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