$(document).ready(function () {
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 5 second for example
    var input = $('.c-navbar-search');

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

        var searchObj = $(".c-navbar-search").val();
        if (searchObj == "") {
            var container = $('.c-navbar-search__results');
            container.css('visibility', 'hidden');
            $('body').css("overflow", "scroll");
            return

        }
        console.log(searchObj);
        $.ajax({
            type: "GET",
            url: "/searchEngine/" + searchObj ,
            async:false,

        })
            .done(function (data) {
                var dataToAppend = '';

                var container = $('.c-navbar-search__results');
                $('body').css('overflow', 'hidden');
                container.css('visibility', 'visible');
                container.css('overflow-y', 'scroll');


                var containerElement = $('.c-navbar-search__result');

                //remove old data
                containerElement.remove();
                data = JSON.parse(data);
                console.log(data);

                //set variables
                var museumsSearchResult = data[0];
                var tourOperatorSearchResult = data[1];

                //create a table with a new data
              if (museumsSearchResult[0] != null){
                  for (let i = 0; i < museumsSearchResult.length; i++) {
                      dataToAppend +=" <a href =\"tourOperator/museum/1\"> <div class=\"c-navbar-search__result\">\n" +
                          "                <img src=\"../images/museums/"+ museumsSearchResult[i][0]+"\" alt=\"asdsa\" class=\"c-navbar-search__result__image\">\n" +
                          "                <h5 class=\"c-navbar-search__result__name\">"+ museumsSearchResult[i][1]+"</h5>\n" +
                          "                <h5 class=\"c-navbar-search__result__city\">"+ museumsSearchResult[i][2] +"</h5>\n" +
                          "                <h5 class=\"c-navbar-search__result__city\">Rating: "+ museumsSearchResult[i][3] +"</h5>\n" +
                          "                <button class=\"btn btn-primary\">Museum</button>\n" +
                          "\n" +
                          "            </div></a>";
                  }
              }


                if (tourOperatorSearchResult[0] != null){
                    for (let i = 0; i < tourOperatorSearchResult.length; i++) {
                        dataToAppend +=" <a href =\"/tourOperator/profile/1\"><div class=\"c-navbar-search__result\">\n" +
                            "                <img src=\"../images/tourOperator/"+ tourOperatorSearchResult[i][0] +"\" alt=\"asdsa\" class=\"c-navbar-search__result__image\">\n" +
                            "                <h5 class=\"c-navbar-search__result__name\">"+ tourOperatorSearchResult[i][1]+"</h5>\n" +
                            "                <h5 class=\"c-navbar-search__result__city\">"+ tourOperatorSearchResult[i][2]+"</h5>\n" +
                            "                <h5 class=\"c-navbar-search__result__city\">Rating: "+ tourOperatorSearchResult[i][3]+"</h5>\n" +
                            "                <button class=\"btn btn-danger\">Tour Operator</button>\n" +
                            "\n" +
                            "            </div></a>";
                    }
                }



                container.append(dataToAppend);

            });
    }

    $('.closeBtn').on('click', function (){
       $('.c-navbar-search__results').css('visibility', 'hidden');

    });


});
