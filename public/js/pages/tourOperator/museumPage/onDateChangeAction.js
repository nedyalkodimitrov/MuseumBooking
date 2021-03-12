

function onDateChangeAction(museumId, date ){
    var today = new Date();
    var currentTime = today.getHours() + ":" + today.getMinutes() ;

    var currentDay = today.getDate();

    var day = date.split('/')[0];

    var data = {'museumId': museumId, 'date' : date};
    let result = ajaxRequest('POST', '/public/tourOperator/getSchedulesByDate', data );

    $('.ticket-reserve-container').css('transition', '0.3s');
    $('.ticket-reserve-container').css('transform', 'translateY(100%)');


    $('.c-schedule-visitor-card--container').remove( );
    if (result.length > 0){
        for (var i = 0; i < result.length; i++){

            var card =          '<div class="col-6 c-schedule-visitor-card--container col-sm-6 col-md-4 col-lg-2 row p-0 justify-content-center mt-3 mt-sm-0">\n' +
                '                    <div class="  c-schedule-visitor-card  col-11">\n' +
                '                        <div class="c-schedule-visitor-card__hour">\n' +
                '                            <h4>'+ result[i][3] +' - ' +result[i][4] +'</h4>\n' +
                '                        </div>\n' +
                '                        <div class="c-schedule-visitor-card__max-capacity">\n' +
                '                            <h5> Price: '+result[i][5]+'</h5>\n' +
                '                        </div>\n' +
                '                        <div class="c-schedule-visitor-card__max-capacity">\n' +
                '                            <h5>Free entry - '+ result[i][1]+'</h5>\n' +
                '                        </div>\n' +
                '                        <div class="c-schedule-visitor-card__max-capacity number" >\n' +
                '                            <input type="number" value="0" min="0" max="' +result[i][1] +'">\n' +
                '                        </div>\n' +
                '                   '+ logicPart(currentTime, result[i][3], result[i][0], currentDay, day)+ '     '+
            '                    </div>\n' +
            '                </div>\n';



            $('.ticket-reserve-container').append(card);


        }
        setTimeout(function () {
            $('.ticket-reserve-container').css('transform', 'translateY(0%)')
        }, 1000);
    }else{
        var text = " <h4 class=\"text-center info c-schedule-visitor-card--container\">This museum doesn't have tickets for this day</h4>";
        $('.ticket-reserve-container').append(text);
    }


}

function logicPart(currentTime, timestr, scheduleId, currentDay, day){
    var text = '';
    console.log(currentDay);
    console.log(day);
    var scheduleTime  = new Date();
    var splitScheduleTime = timestr.split(':');
    scheduleTime.setHours(splitScheduleTime[0], splitScheduleTime[1] +  0);
    var scheduleTimeForCompare =( (scheduleTime.getHours()<10?'0':'') + scheduleTime.getHours()) + ":"+ ((scheduleTime.getMinutes()<10?'0':'') + scheduleTime.getMinutes());

     if(currentTime < scheduleTimeForCompare || currentDay < day) {
         text =
             '                            <div class="c-schedule-visitor-card__done">\n' +
             '                                <button value="'+ scheduleId+'"onclick="bookTicket()" class="reserve-ticket-btn">Reserve</button>\n' +
             '                            </div>\n'
     }else{
         text =  '<div class="c-schedule-visitor-card__wait">\n' +
         '                                <button>Time Out  <i class="fas fa-clock ml-1"></i></button>\n' +
         '                            </div>\n'
     }
     return text;

}

