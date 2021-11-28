$('#show-tour-operator-search').on('click', function (){
    $('#tour-operator-search-container').css('transform', 'translateY(0%)')

});


$('#show-museum-search').on('click', function (){
    $('#museums-search-container').css('transform', 'translateY(0%)')

});


$('#show-landmarks-search').on('click', function (){
    $('#landmarks-search-container').css('transform', 'translateY(0%)')

});





$('.c-hidden-search__container__close-button').on('click', function (){
   $(this).parent().parent().css('transform', 'translateY(-100%)');

});