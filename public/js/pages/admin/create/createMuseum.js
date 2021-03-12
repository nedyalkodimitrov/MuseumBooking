$('.btn').on('click', function (){
    var museumName = $('#museum_museumName').val();
    var museumMaxCapacity = $('#museum_maxCapacity').val();
    var museumCity = $('#museum_city').val();
    var userEmail = $('#user_email').val();
    var userPassword = $('#user_password').val();

    var data = {'name' : museumName,
        'maxCapacity' : museumMaxCapacity,
        'city' : museumCity,
        'email' : userEmail,
        'password' : userPassword
    }
    console.log(data);
    let result = ajaxRequest('POST', '/admin/createMuseumAction', data );
    console.log(result);
    location.reload();


});