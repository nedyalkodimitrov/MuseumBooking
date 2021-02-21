function ajaxRequest(type, url, data){
   let messege = 0;
    $.ajax({
        type: type,
        url: url,
        async: false,
        data: data,
    }).done(function (msg) {
        messege =  msg;
    });
return messege;

}