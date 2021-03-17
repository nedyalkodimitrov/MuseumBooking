$('.createScheduleBtn').on('click', function () {
    var startHour = $("#startHour").val();
    var endHour = $("#endHour").val();
    var day = $("#day").text();
    var price = $('#price').val();
    $('.c-hidden-container__button').disable = true;

    let type = "POST";
    let url = "/museum/createSchedule";
    let data = {'startTime': startHour, 'endTime': endHour, 'dayName': day, 'price': price};

    console.log(ajaxRequest(type, url, data));
    location.reload();


});