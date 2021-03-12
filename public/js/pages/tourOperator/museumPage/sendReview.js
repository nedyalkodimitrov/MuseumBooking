$('.c-tourOperator-museum-feedback-form__sendBtn').on('click', function (){
    var rating = $('.c-tourOperator-museum-feedback-form__rating').val();
    var text = $('.c-tourOperator-museum-feedback-form__textarea').val();
    var museumId = $('.museumId').val();

    var url = "/public/tourOperator/makeReview";
    var type = 'POST';
    var data = {'text': text, 'rating' : rating, 'museumId' : museumId};

    ajaxRequest(type, url, data)
    location.reload();

});