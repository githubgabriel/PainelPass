/* Ajax REFRESH TABLE CONTEUDO */
function updateTable() {
    $("table#registros tbody").html("Update...");
    $.post("ajax/getTable.php", function(content) { $("table#registros tbody").html(content); });

}


$(function() {

    /* FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS FILTROS */

    var filtro_string = $("input[name=filtro_string]");
    var filtro_tipo = $("select[name=filtro_tipo]");
    var filtro_categoria = $("select[name=filtro_categoria]");

    filtro_tipo.on("change", function() {
        $.post("ajax/setFiltro.php", { id: "tipo", valor: this.value }, function() { updateTable(); });
    });

    filtro_categoria.on("change", function() {
        $.post("ajax/setFiltro.php", { id: "categoria", valor: this.value }, function() { updateTable(); });
    });

    filtro_string.on("keyup", function() {
        $.post("ajax/setFiltro.php", { id: "string", valor: this.value }, function() { updateTable(); });
    });


    /* Criar novo Registro */
    var btn_criarnovo = $("input#btn_criarnovo");
    var btn_registrar = $("input#btn_registrar");
    var btn_cancelar = $("input#btn_cancelar");
    var div_novoreg = $("div#novoregistro");
    btn_registrar.on("click", function() {
        var data = div_novoreg.find("input").serialize();
        $.post("ajax/newReg.php", data, function(content) { alert(content); updateTable(); div_novoreg.find("input").not("input.btn").val(""); });
    });
    btn_criarnovo.on("click", function() {
        div_novoreg.show(500);
        btn_criarnovo.hide();
    });
    btn_cancelar.on("click", function() {
        div_novoreg.hide(500);
        btn_criarnovo.show();
    });

    /* Deletar Registro dinamic ajax */
    var btn_deletar = $("a#btn_deletar");
    $("table#registros").on("click", btn_deletar, function(e) {
        var data = $("a#btn_deletar",this).data("id");
        $.post("ajax/deleteReg.php", {id: data}, function(content) {  updateTable(); });
    });
    
});