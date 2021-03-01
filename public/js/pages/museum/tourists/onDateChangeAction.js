

function onDateChangeAction( date ){
    var day = date;
    var data = { 'date' : date};

    console.log(data);
    let result = ajaxRequest('POST', '/museum/getTouristsByDate', data );

    $('.ticket-reserve-container').css('transition', '0.3s');
    $('.ticket-reserve-container').css('transform', 'translateY(100%)');


    console.log(result);
    console.log(222);
    console.log(result != null);
    $('.tourist-card').remove( );
    if (result.length > 0){

        // result = JSON.parse(result);
        console.log(result.length);
        for (var i = 0; i < result.length; i++){
            console.log(result);

            var card =          ' <div class="col-12 col-lg-6 tourist-card container mx-auto ">\n' +
                '               <div class="col-12 c-visitor-card mx-auto row">\n' +
                '                   <div class="col-12 row c-visitor-card__first-page">\n' +
                '                       <div class="col-12 c-visitor-card__hour">\n' +
                '                           <h4>'+result[i][1]+ ' - '+ result[i][2]+'</h4>\n' +
                '                       </div>\n' +
                '                       <div class="c-visitor-card__image-container col-4 ">\n' +
                '                           <img src="../../../../images/user-profile-image.jpg") }}" alt="">\n' +
                '                       </div>\n' +
                '                       <div class="c-visitor-card__credential col-8">\n' +
                '                           <div class="c-visitor-card__credential__name">\n' +
                '                               <h4>'+result[i][4]+ ' '+result[i][5]+ ' </h4>\n' +
                '                           </div>\n' +
                '                           <div class="c-visitor-card__credential__booked-tickets">\n' +
                '                               <h5>Резервирани билета - '+result[i][3]+'</h5>\n' +
                '\n' +
                '                           </div>\n' +
                '\n' +
                '                           <div class="c-visitor-card__credential__visit-rate">\n' +
                '                              '+result[i][6]+'/5\n' +
                '                           </div>\n' +
                '                       </div>\n' +
                '                   </div>\n' +
                '                   <div class="c-visitor-card__second-page">\n' +
                '                       <h4>Can not chage visit rating  </h4>\n' +
                '                   </div>\n' +
                '\n' +
                '               </div>\n' +
                '\n' +
                '           </div>';



            $('.touristContainer').append(card);


        }
        setTimeout(function () {
            $('.ticket-reserve-container').css('transform', 'translateY(0%)')
        }, 1000);
    }else{
        var text = " <h4 class=\"text-center info c-schedule-visitor-card--container\">This museum doesn't have tickets for this day</h4>";
        $('.ticket-reserve-container').append(text);
    }


}
