$(window).on('load', function() {


    $('#register').click(function() {
        $('input[type="text"]').val('');
        $('input[type="password"]').val('');
        $('#modalRegister').show();
    });

    $('#closeRegister').click(function() {
        $('#modalRegister').modal('toggle');
    });

    /* Elemento DIV que cambia su texto */
    var closeRegister = document.getElementById("closeRegisterButton");

    /* Se agrega el evento al elemento */
    closeRegister.addEventListener("click", close);

    /* Función que se gatilla al hacer click en el elemento DIV */
    function close() {
        console.log('close');
        $('#modalRegister').modal('toggle');
    }

    // var buttonRegister = document.getElementById("buttonRegister");
    // buttonRegister.addEventListener("click", register);

    // function register() {
    //     var arrayDataUser = getDataUser();
    //     console.log('buttonRegister', arrayDataUser);
    //     $.ajax({
    //         url: 'https://127.0.0.1:8000/register',
    //         type: 'POST',
    //         data: { 'user': arrayDataUser },
    //         success: function(data) {
    //             alert('El servidor devolvio "' + data + '"');
    //         }
    //     })
    // }

    // function getDataUser() {

    //     var arrayDataUser = {};
    //     var userName = document.getElementById("userName").value;
    //     var email = document.getElementById("email").value;
    //     var password = document.getElementById("passwordRegister").value;
    //     var repeatPassword = document.getElementById("repeatPassword").value;
    //     var checbox = document.getElementById("checkbox").value;
    //     arrayDataUser = {
    //         'userName': userName,
    //         'email': email,
    //         'password': password
    //     }
    //     return arrayDataUser;
    // }

});