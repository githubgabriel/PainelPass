$(function() {


    /* FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS */

    var filtro_tipo = $("select[name=filtro_tipo]");
    var filtro_categoria = $("select[name=filtro_categoria]");

    filtro_tipo.on("change", function() {
        $.post("ajax/setFiltro.php", { id: "tipo", valor: this.value }, function() { updateTable(); });
    });


    filtro_categoria.on("change", function() {
        $.post("ajax/setFiltro.php", { id: "categoria", valor: this.value }, function() { updateTable(); });
    });



    /* Ajax REFRESH TABLE CONTEUDO */

    function updateTable() {
        $("table#registros tbody").html("Update...");
        $.post("ajax/getTable.php", function(content) { $("table#registros tbody").html(content); });
    }


});