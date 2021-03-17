
$('.c-button--danger').on('click', function () {

    var id = $(this).val();

    $('#deleteSchedule').on('click', function () {
        let type = "POST";
        let url = "/museum/deleteSchedule";
        let data = {"scheduleId": id};

        console.log(ajaxRequest(type, url, data));
        location.reload();

    });

});

