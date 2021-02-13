
$("#calendarDays td.active").on("click", function () {
    var dateInSting = $(this).text() + "/" + "0"+($('#month').data('val') + 1) + "/" + $('#year').text();
    var museumId = document.getElementById('museumId').value;

    onDateChangeAction(museumId,  dateInSting);

});
