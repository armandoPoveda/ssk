var buttonRegister = document.getElementById("buttonLogin");
buttonRegister.addEventListener("click", login);
var dataUser;

function login() {
    var userName = document.getElementById("userName").value;
    var password = document.getElementById("passwordLogin").value;
    $.ajax({
        url: 'https://127.0.0.1:8000/login?userName=' + userName + '&passwordLogin=' + password,
        type: 'POST',
        // data: { 'user': arrayDataUser },
        success: function(data) {
            console.log(data);
            // dataUser = data;
            // var login = document.getElementById("login");
            // login.innerText = userName;
        }
    });
}