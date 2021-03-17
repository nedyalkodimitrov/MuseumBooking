
$('#saveAdditionalInformation').on('click', function (){
    var addInformation = $('.additionalInformation').val();
    let type = "POST";
    let url = "/museum/additionInformationChange";
    let data = {"additionalInformation": addInformation};

    console.log(ajaxRequest(type, url, data));
    $('.textarea-btn').attr("disabled", "disabled");
    $('.textareaInfo').val(addInformation)
});
