$(window).on('load', function() {


    $('#login').click(function() {
        $('input[type="text"]').val('');
        $('input[type="password"]').val('');
        $('#modalLogin').show();
    });

    $('#close').click(function() {
        $('#modalLogin').modal('toggle');
    });

    $('#register').click(function() {
        $('input[type="text"]').val('');
        $('input[type="password"]').val('');
        $('#modalRegister').show();
    });

    $('#closeRegister').click(function() {
        $('#modalRegister').modal('toggle');
    });

    var closeLogin = document.getElementById("closeLogin");
    var closeRegister = document.getElementById("closeRegisterButton");

    // closeLogin.addEventListener("click", closeLoginFunc);
    // closeRegister.addEventListener("click", closeRegisterFunc);

    function closeLoginFunc() {
        console.log('close');
        $('#modalLogin').modal('toggle');
    }

    function closeRegisterFunc() {
        console.log('close');
        $('#modalRegister').modal('toggle');
    }

    $.ajax({
        url: 'https://127.0.0.1:8000/login/',
        success: function(respuesta) {
            // console.log(respuesta);
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });

    var buttonLogin = document.getElementById("buttonLogin");
    console.log(buttonLogin);
    buttonLogin.addEventListener("click", login);

    function login() {
        var arrayDataUser = getDataUser();
        console.log('buttonLogin', arrayDataUser);
        console.log('login');
        $.ajax({
            url: 'https://127.0.0.1:8000/login/',
            type: 'get',
            // data: { 'user': arrayDataUser },
            success: function(data) {
                console.log(data);
            }
        })

        function getDataUser() {

            var arrayDataUser = {};
            var userName = document.getElementById("userName").value;
            var password = document.getElementById("passwordLogin").value;

            arrayDataUser = {
                'userName': userName,
                'password': password
            }

            return arrayDataUser;
        }

    }

});