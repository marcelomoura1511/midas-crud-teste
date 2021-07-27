$(document).ready(function () {
    $("#categorias").selectpicker({
        noneSelectedText : 'Selecione' // by this default 'Nothing selected' -->will change to Please Select
    });
});

$(".hasDatepicker2").datepicker({
    dateFormat: 'dd/mm/yy',
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior'
});

$("#publicado").change(function(){
    if($("#publicado").is(":checked")){
        $("#data-publicacao-row").css("display", "block");
        $("input[name='data_publicacao']").prop("required", true);
    }else{
        $("#data-publicacao-row").css("display", "none");
        $("input[name='data_publicacao']").prop("required", false);
    }
});