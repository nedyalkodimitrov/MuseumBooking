
$(document).ready(function () {
    var museumTypingTimer;                //timer identifier
    var museumDoneTypingInterval = 500;  //time in ms, 5 second for example
    var museumInput = $('#museum-search');

    //on keyup, start the countdown
    museumInput.on('keyup', function () {
        clearTimeout(museumTypingTimer);
        museumTypingTimer = setTimeout(museumDoneTyping, museumDoneTypingInterval);
    });

    //on keydown, clear the countdown
    museumInput.on('keydown', function () {
        clearTimeout(museumTypingTimer);
    });

    function museumDoneTyping() {
        var searchObj = $("#museum-search").val();
        console.log(searchObj);
        if (searchObj == "") return;

        $.ajax({
            type: "GET",
            url:"/searchMuseum/" + searchObj ,
            async:false,

        })
            .done(function (returnedData) {
                var searchResult = JSON.parse(returnedData);
                var searchContainer = $('#museums-search-results');
                var items = $('.museum-results');
                var museumHtml = '';
                //remove old data
                items.remove();

                if (searchResult != null){
                    museumHtml = turnSearchResultToHtml(searchResult);
                }
                searchContainer.append(museumHtml);
            });
    }
});


function turnSearchResultToHtml(searchResult){
    var museumHtml = '';

    for (let i = 0; i < searchResult.length; i++) {
        museumHtml +=" <a href =\"/public/general/museumsProfile/"+  searchResult[i][4] +"\" class=\"col-12 c-hidden-search__container__results__row  tour-operator-result row \">\n" +
            "                <img src=\"/images/museum/"+ searchResult[i][0]+"\" alt=\"asdsa\" class=\"c-hidden-search__container__results__row__image col-1\">\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__name col-3\">"+ searchResult[i][1]+"</h5>\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__city col-3\">"+ searchResult[i][2] +"</h5>\n" +
            "                <h5 class=\"c-hidden-search__container__results__row__city col-3\">Rating: "+ searchResult[i][3] +"</h5>\n" +
            "                <button class=\'btn\'><h5>Добави</h5></button>\n" +
            "\n" +
            "            </a>";
    }
    return museumHtml;
}