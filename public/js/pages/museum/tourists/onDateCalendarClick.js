
$("#calendarDays td.active").on("click", function () {
    var dateInSting =  $('#year').text() + "-" + "0" + ($('#month').data('val') + 1  + "-" + $(this).text() ) ;
    var museumId = document.getElementById('museumId');
    onDateChangeAction( dateInSting);

});
