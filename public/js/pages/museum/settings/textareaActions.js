
$('textarea').on("keypress", function (){
    $('.textarea-btn').removeAttr("disabled");

});

$('.textarea-btn-decline').on('click', function (){
    $('textarea').val( $('.textareaInfo').val());
    $('.textarea-btn').attr("disabled", "disabled");

});

