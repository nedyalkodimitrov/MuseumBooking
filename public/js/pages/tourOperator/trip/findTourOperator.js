
$(document).ready(function () {
    var tourOperatorTypingTimer;                //timer identifier
    var tourOperatorDoneTypingInterval = 500;  //time in ms, 5 second for example
    var tourOperatorInput = $('#tour-operator-search');

    //on keyup, start the countdown
    tourOperatorInput.on('keyup', function () {
        clearTimeout(tourOperatorTypingTimer);
        tourOperatorTypingTimer = setTimeout(tourOperatorDoneTyping, tourOperatorDoneTypingInterval);
    });

    //on keydown, clear the countdown
    tourOperatorInput.on('keydown', function () {
        clearTimeout(tourOperatorTypingTimer);
    });

    function tourOperatorDoneTyping() {
        var searchObj = $("#tour-operator-search").val();

        if (searchObj == "") return;

        $.ajax({
            type: "GET",
            url:"/searchTourOperator/" + searchObj ,
            async:false,

        })
            .done(function (returnedData) {
                var searchResult = JSON.parse(returnedData);
                var searchContainer = $('#tour-operator-search-results');
                var items = $('.tour-operator-result');
                console.log(searchResult);
                var tourOperatorHtml = '';
                //remove old data
                items.remove();

                if (searchResult != null){
                    tourOperatorHtml = turnSearchResultToHtml(searchResult);
                }
                searchContainer.append(tourOperatorHtml);
            });
    }
});


function turnSearchResultToHtml(searchResult){
    var tourOperatorHtml = '';

    for (let i = 0; i < searchResult.length; i++) {
        tourOperatorHtml +=" <a href =\"/public/general/museumsProfile/"+  searchResult[i][4] +"\" class=\"col-12 c-hidden-search__container__results__row  tour-operator-result row \">\n" +
            "                <img src=\"/images/tourOperator/"+ searchResult[i][0]+"\" alt=\"asdsa\" class=\"c-hidden-search__container__results__row__image col-1\">\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__name col-3\">"+ searchResult[i][1]+"</h5>\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__city col-3\">"+ searchResult[i][2] +"</h5>\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__city col-3\">Rating: "+ searchResult[i][3] +"</h5>\n" +
            "                <button class=\'btn\'><h5>Добави</h5></button>\n" +
            "\n" +
            "            </a>";
    }
    return tourOperatorHtml;
}