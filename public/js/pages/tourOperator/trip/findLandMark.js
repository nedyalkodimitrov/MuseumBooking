
$(document).ready(function () {
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 5 second for example
    var input = $('#landmarks-search');

    //on keyup, start the countdown
    input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    function doneTyping() {
        var searchObj = $("#landmarks-search").val();

        if (searchObj == "") return;

        $.ajax({
            type: "GET",
            url:"/searchLandmark/" + searchObj ,
            async:false,

        })
            .done(function (returnedData) {
                var searchResult = JSON.parse(returnedData);
                var searchContainer = $('#landmarks-search-results');
                var items = $('.landmark-results');
                var landmarkHtml = '';
                //remove old data
                items.remove();

                if (searchResult != null){
                    landmarkHtml = turnSearchResultToHtml(searchResult);
                }
                searchContainer.append(landmarkHtml);
            });
    }
});


function turnSearchResultToHtml(searchResult){
    var landmarkHtml = '';

    for (let i = 0; i < searchResult.length; i++) {
        landmarkHtml +=" <a href =\"/public/general/museumsProfilemuseumsProfile/"+  searchResult[i][4] +"\"> <div class=\"c-hidden-search__container__results__row  landmark-results\">\n" +
            "                <img src=\"/public/images/museums/"+ searchResult[i][0]+"\" alt=\"asdsa\" class=\"c-navbar-search__result__image\">\n" +
            "                <h5 class=\"c-navbar-search__result__name\">"+ searchResult[i][1]+"</h5>\n" +
            "                <h5 class=\"c-navbar-search__result__city\">"+ searchResult[i][2] +"</h5>\n" +
            "                <h5 class=\"c-navbar-search__result__city\">Rating: "+ searchResult[i][3] +"</h5>\n" +
            "\n" +
            "            </div></a>";
    }
    return landmarkHtml;
}