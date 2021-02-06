function bookTicket(){
    $('.reserve-ticket-btn').on('click', function (){
        var scheduleId = this.value;
        var numberOfTickets = this.parentNode.parentNode.querySelector('.number').querySelector('input').value
        console.log();
        var dateText =  $('.schedules-day-text').text();
        var splitDate = dateText.split();
        let result = ajaxRequest('POST', '/tourOperator/bookTicket', {"scheduleId": scheduleId, "number" : numberOfTickets, "reservedDate": splitDate[0]});
        console.log(result);
    });

}