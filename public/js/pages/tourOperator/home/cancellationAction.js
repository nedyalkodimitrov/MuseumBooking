$('.cancellation-btn').on('click', function (){
   var ticketID = $(this).val();
   var type = 'GET';
   var url = '/tourOperator/unbookTicket/' + ticketID;
   var data = [];
   var response = ajaxRequest(type, url, data);
   if (response == 1){
      location.reload(true);

   }
});