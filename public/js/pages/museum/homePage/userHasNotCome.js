$('.userHasNotCome').on('click', function (){

    var ticketId = $(this).val();

    var url = '/public/museum/userHasNotCome';
    var type = 'POST';
    var data = {'ticketId' : ticketId};
    ajaxRequest(type, url, data);

    location.reload();
});
