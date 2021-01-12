let arrAppointment;

$(function () {
    if (typeof (Storage) !== "undefined") {
        arrAppointment = localStorage.getItem("tbAppointment");
        arrAppointment = JSON.parse(arrAppointment);
        $("#btn_clear_storage").prop('disabled', false);
        $(`#btn_clear_storage`).show();
        if (arrAppointment == null || arrAppointment == "[null]"){
            $("#btn_clear_storage").prop('disabled', true);
            $(`#btn_clear_storage`).hide();
            arrAppointment = [];
            arrAppointment.push(JSON.parse(localStorage.getItem('tbAppointment')));
            localStorage.setItem('tbAppointment', JSON.stringify(arrAppointment));
        }
    } else {
        iziToast.warning({
            title: 'Caution',
            message: "Sorry, but your web browser do not support localstorage, therefore this app won't work as it suposed to. Try updating your browser first.",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 20000,
        });
    }

    $('#description').inputmask('Regex', {
        regex: "(?:[\\w\\d]+(\\s)*){1,5}",
        clearIncomplete: true
    });

    $("#start_time").inputmask("hh:mm", {
        placeholder: "hh:mm (24h)",
        alias: "datetime",
        clearIncomplete: true,
        oncomplete: function(){
            $("#end_time").focus();
        }});

    $("#end_time").inputmask("hh:mm", {
        placeholder: "hh:mm (24h)",
        alias: "datetime",
        clearIncomplete: true,
        oncomplete: function(){
            compare();
            $("#submit").focus();
        }});

    $(".date-input").inputmask("dd/mm/yyyy", {
        placeholder: "dd/mm/YYYY",
        alias: "datetime",
        clearIncomplete: true
    });

    $('[data-toggle="popover"]').popover();

    print(false, true);

});

let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
console.log(currentYear);
let months = ["Януари", "Февруари ", "Март", "Април", "Май", "Юни", "Юли", "Август", "Септември", "Октомври", "Ноември", "December"];

showCalendar(currentMonth, currentYear);


function showCalendar(month, year) {
    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById('calendarDays');
    console.log(tbl);
    tbl.innerHTML = "";

    $("#month").text(months[month]);
    $("#month").data("val", month);
    $("#year").text(year);

    let date = 1;

    for (let i = 0; i < 6; i++) {
        let row = document.createElement("tr");
        row.className = `week week_${i}`;

        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay - 1) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.classList.add("inactive");
                cell.classList.add("disabled");
                cell.classList.add("bg-secondary");
                cell.setAttribute('data-day', date);
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("active");
                    cell.classList.add("text-white");
                    cell.classList.add("current-day");
                    cell.classList.add("today");
                    cell.classList.add("text-center");
                    cell.classList.add("font-weight-bold");
                    cell.setAttribute('data-day', date);
                    put_badges(cell);
                } else if (date < today.getDate() && year <= today.getFullYear() && month <= today.getMonth()){
                    cell.classList.add("inactive");
                    cell.classList.add("disabled");
                    cell.classList.add("text-white");
                    cell.classList.add("bg-light");
                    cell.classList.add("text-muted");
                    cell.classList.add("text-center");
                    cell.classList.add("font-weight-light");
                    cell.setAttribute('data-day', date);
                    cell.setAttribute('disabled', 'disabled');
                } else if (date >= today.getDate() && year >= today.getFullYear() && month >= today.getMonth()) {
                    cell.classList.add("active");
                    cell.classList.add("day");
                    cell.classList.add("text-center");
                    cell.classList.add("font-weight-bold");
                    cell.setAttribute('data-day', date);
                    put_badges(cell);
                }
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }
        }
        tbl.appendChild(row);
    }

}

$("#calendarDays td.active").on("click", function () {
    var dateInSting = $(this).text() + "/" + "0"+($('#month').data('val') + 1) + "/" + $('#year').text();

    var d = new  Date("16/01/2021");
    var weekday = new Array(7);
    weekday[0] = "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";
    var n = weekday[d.getDay()];
    console.log(n);
    console.log(d);

    ticketsAnimationOnDateChange();

    $('.current-day').removeClass("active");
    $('.current-day').removeClass("text-white");
    $('.current-day').removeClass("today");
    $('.current-day').removeClass("text-center");
    $('.current-day').removeClass("font-weight-bold");
    $('.current-day').addClass("active");

    $('.current-day').addClass("day");
    $('.current-day').addClass("text-center");
    $('.current-day').addClass("font-weight-bold");
    $('.current-day').removeClass("current-day");


    $(this).addClass("active");
    $(this).addClass("text-white");
    $(this).addClass("current-day");
    $(this).addClass("today");
    $(this).addClass("text-center");
    $(this).addClass("font-weight-bold");

    console.log($(this).text());
    $('.schedules-day-text').text($(this).text() + "/" + ($('#month').data('val') + 1) + "/" + $('#year').text() + " Tickets") ;

    if (is_empty() == true) {
        $("#submit").prop('disabled', true);
    } else {
        $("#submit").prop('disabled', false);
    }
    if ($("#description").val() == null || $("#description").val() == '') {
        $("#description").focus();
    } else {
        $("#submit").focus();
    }
});

$("#calendarDays td.inactive").on("click", function () {
    iziToast.error({
        title: 'Error',
        message: "You can make appointments just today and foward",
        overlay: true,
        zindex: 999,
        position: 'center',
        timeout: 3000,
    });
});

function make_appointment() {
    if (is_empty() == false) {
        is_past_date();
        compare();
        if (is_overlap() == false) {
            var appointment = {
                id: $("#date").inputmask('unmaskedvalue')+$("#start_time").inputmask('unmaskedvalue')+$("#end_time").inputmask('unmaskedvalue'),
                date: $("#date").val(),
                description: $("#description").val(),
                start_time: $("#start_time").val(),
                end_time: $("#end_time").val(),
            };

            var date = $("#date").val();
            var description = $("#description").val();
            var start_time= $("#start_time").val() ;
            var end_time = $("#end_time").val();

            $.ajax({
                method: "POST",
                data: {"description": description, "date": date, "startTime": start_time, "endTime": end_time},
                url: "/coache/setTraining",
            })
                .done(function( msg ) {
                    console.log(msg);
                    console.log(date);

                });



            SaveDataToLocalStorage(appointment);
            $("#btn_clear_storage").prop('disabled', false);
            $(`#btn_clear_storage`).show();
            print();

            clear_input();
            iziToast.success({
                title: 'Success',
                message: 'Събитието е създадено',
                position: 'top',
            });
        } else {
            clear_input();
            iziToast.error({
                title: 'Error',
                message: "This appointment is overlaping another one",
                overlay: true,
                zindex: 999,
                position: 'center',
                timeout: 3000,
            });
        }
    } else {
        iziToast.error({
            title: 'Error',
            message: "All input fields are needed in order to make an appointment",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
        });
    }
}

$("#end_time, #start_time").focusout(function () {
    compare();
});

$("#end_time, #start_time, #date").keyup(function () {
    if (is_empty() == true) {
        $("#submit").prop('disabled', true);
    } else {
        $("#submit").prop('disabled', false);
    }
});

function clear_input() {
    $("#date").val('');
    $("#description").val('');
    $("#start_time").val('');
    $("#end_time").val('');
    $("#submit").prop('disabled', true);
}


function is_empty() {
    if (
        ($("#date").val() == null || $("#date").val() == '') ||
        ($("#start_time").val() == null || $("#start_time").val() == '') ||
        ($("#end_time").val() == null || $("#end_time").val() == '')
    ) {
        return true;
    }
    return false;
}

function compare() {
    var startTime = Date.parse(get_Date($("#start_time").val()));
    var endTime = Date.parse(get_Date( $("#end_time").val()));

    if (startTime > endTime) {
        $("#submit").prop('disabled', true);
        clear_input();
        iziToast.warning({
            title: 'Caution',
            message: "Start time can not be greater than end time",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 2000,
        });
    }
    if (startTime == endTime) {
        $("#submit").prop('disabled', true);
        clear_input();
        iziToast.warning({
            title: 'Caution',
            message: "Start time and end time can not be equals",
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 2000,
        });
    }
}

function is_past_date() {
    var today = new Date();
    var arrDate = GetDateInput();
    var selected_date = new Date(arrDate[2], arrDate[1]-1, arrDate[0], 0, 0, 0, 0);
    if (selected_date < today) {
        return true;
    }
    return false;
}

function GetDateInput() {
    var date = $("#date").val();
    return date.split("/");
}

function is_overlap(sTime, eTime) {
    if (sTime == undefined || eTime == undefined) {
        sTime = $("#start_time").val();
        eTime = $("#end_time").val();
    }
    if (+get_Date(sTime) < +get_Date(eTime)) {
        var timeList = localStorage.getItem("tbAppointment");
        if (timeList == null || timeList == "[null]"){
            return false
        } else {
            timeList = JSON.parse(timeList);
        }

        for (let i = 0; i < timeList.length; i++) {
            const element = timeList[i];
            if (element.date == $("#date").val()) {
                if (
                    sTime > element.start_time && sTime < element.end_time ||
                    eTime > element.start_time && eTime < element.end_time ||
                    sTime < element.start_time && eTime >= element.end_time ||
                    sTime <= element.start_time && eTime > element.end_time ||
                    sTime == element.start_time && eTime == element.end_time

                ) {
                    return true;
                }
            }
        }
        return false;
    } else {
        return false;
    }
}

function get_Date(time, arrDate = false) {
    if (arrDate == false) {
        var arrDate = GetDateInput();
    }
    var date = new Date(arrDate[2], arrDate[1]-1, arrDate[0], 0, 0, 0, 0);
    var _t = time.split(":");
    date.setHours(_t[0], _t[1], 0, 0);
    return date;
}

function print(clear = false, init = false, edit = false) {
    if (clear != false){
        $("#appointment_list > tbody").html("");
        return true;
    };
    var data = localStorage.getItem("tbAppointment");
    data = JSON.parse(data);
    if (data[0] !== null) {
        $("#appointment_list > tbody").html("");
        $(`.week td.active`).removeClass('badge1');
        $(`.week td.active`).removeAttr( "data-badge" );
        let date = [];
        if (data.length !== 0) {
            for (let i = 0; i < data.length; i++) {
                const element = data[i];
                $("#appointment_list > tbody").append(

                );
                let currDate = element.date.split("/");
                date.push(currDate[0]);
            }
            date = [...new Set(date)];
            date.forEach(element => {
                let cell = document.querySelector(`.week > td.active[data-day='${element}']`);
                put_badges(cell);
            });
        } else {
            let element = document.querySelector(`.week > td.active[data-badge]`);
            if (element !== null) {
                put_badges(element);
            }
        }
    }
}

function SaveDataToLocalStorage(data)
{
    var a = [];
    a = JSON.parse(localStorage.getItem('tbAppointment'));

    var a = a.filter(function (el) {
        return el != null;
    });

    a.push(data);
    a.sort(function (sTime1, sTime2) {
        let temp3 = parseInt(sTime1.date.slice(0,2))
        let temp4 = parseInt(sTime2.date.slice(0,2))
        let temp1 = Date.parse(get_Date(sTime1.start_time));
        let temp2 = Date.parse(get_Date(sTime2.start_time));


        if (temp3 > temp4) return 1;
        if (temp3 < temp4) return -1;
        if (temp1 > temp2) return 1;
        if (temp1 < temp2) return -1;
    });
    localStorage.setItem('tbAppointment', JSON.stringify(a));
    console.log(data);
}

function clear_storage(){
    localStorage.clear();
    var arrAppointment = [];
    arrAppointment.push(JSON.parse(localStorage.getItem('tbAppointment')));
    localStorage.setItem('tbAppointment', JSON.stringify(arrAppointment));
    $("#btn_clear_storage").prop('disabled', true);
    $(`#btn_clear_storage`).hide();
    $(`.week td.active`).removeClass('badge1');
    $(`.week td.active`).removeAttr( "data-badge" );
    print(true);
    iziToast.success({
        title: 'Success',
        message: 'All appointments deleted',
    });
}

function edit_appointment(id){
    var data = localStorage.getItem("tbAppointment");
    data = JSON.parse(data);
    if (data[0] !== null) {
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            if (element.id == id) {
                $("#date").val(element.date);
                $("#description").val(element.description);
                $("#start_time").val(element.start_time);
                $("#end_time").val(element.end_time);
                $("#submit").prop('disabled', false);
                delete_appointment(id);
            }
        }
    }
};

function delete_appointment(id){
    var data = localStorage.getItem("tbAppointment");
    data = JSON.parse(data);
    if (data[0] !== null) {
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            if (element == null) {
                data.splice(i, 1);
            }
            if (element.id == id) {
                data.splice(i, 1);
            }
        }
        data = data.filter(function (el) {
            return el != null;
        });

        localStorage.setItem('tbAppointment', JSON.stringify(data));
        print(false, false, true);
        iziToast.success({
            title: 'Success',
            message: 'Appointment deleted',
        });

    }
};


function put_badges(cell) {
    var data = localStorage.getItem("tbAppointment");
    data = JSON.parse(data);
    if (data[0] !== null) {
        let counter = 0;
        for (let i = 0; i < data.length; i++) {
            const element = data[i];
            if (cell.getAttribute("data-day") == element.date.slice(0,2)) {
                counter++;
            }
        }

        if (counter >= 1) {
            cell.classList.add("badge1");
            cell.setAttribute('data-badge', counter);
        }
        /*if (counter <= 0) {
            cell.classList.remove("badge1");
            cell.removeAttribute('data-badge');
        }*/
    }
}

function sort_database(data){
    return data.sort(function (sTime1, sTime2) {
        let temp3 = parseInt(sTime1.date.slice(0,1))
        let temp4 = parseInt(sTime2.date.slice(0,1))
        let temp1 = Date.parse(get_Date(sTime1.start_time));
        let temp2 = Date.parse(get_Date(sTime2.start_time));


        if (temp3 > temp4) return 1;
        if (temp3 < temp4) return -1;
        if (temp1 > temp2) return -1;
        if (temp1 < temp2) return 1;
    });
}

