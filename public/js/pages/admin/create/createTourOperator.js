$('.btn').on('click', function (){
    var name = $('#tour_operator_name').val();
    var fName = $('#tour_operator_fName').val();
    var city = $('#tour_operator_city').val();
    var phoneNumber = $('#tour_operator_phoneNumber').val();
    var userEmail = $('#user_email').val();
    var userPassword = $('#user_password').val();

    var data = {'name' : name,
        'fName' : fName,
        'city' : city,
        'phoneNumber' : phoneNumber,
        'email' : userEmail,
        'password' : userPassword
    }

    console.log(data);
    let result = ajaxRequest('POST', '/admin/createTourOperatorAction', data );
    console.log(result);


});