$('.userHasCome').on('click', function (){

    var ticketId = $(this).val();

    var url = '/public/museum/userHasCome';
    var type = 'POST';
    var data = {'ticketId' : ticketId};
    ajaxRequest(type, url, data);

    location.reload();
});
