$('#endHour').on('focusout', function (){
    var endHour = $('#endHour').val();
    var startHour = $('#startHour').val();

    if (endHour == ''){
        return;
    }

    if (endHour <= startHour ){
        $('#endHour').value == ""
        iziToast.warning({
            title: 'Warning',
            message: 'Start time has to be earlier than end time',
            position: 'center',
            timeout: 5000,

        });
    }


    if (endHour == "24:00"){
        $('#endHour').value == "";
        // iziToast.show({
        //     title: 'Warning!',
        //     message: 'End time has to be earlier than 24:00',
        //     position: 'center',
        //     timeout: 3000,
        //     close: true,
        //     closeOnEscape: true,
        //     closeOnClick: true,
        //     transitionIn: 'flipInX',
        //     transitionOut: 'flipOutX',
        // });
    }

});