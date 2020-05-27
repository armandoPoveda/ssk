$(window).on('load', function() {

    /* Elemento DIV que cambia su texto */
    var buttonSend = document.getElementById("buttonSend");

    /* Se agrega el evento al elemento */
    buttonSend.addEventListener("click", sendForm);

    /* Elemento DIV que cambia su texto */
    var buttonCancel = document.getElementById("buttonCancel");

    /* Se agrega el evento al elemento */
    buttonCancel.addEventListener("click", cancelForm);

    /* Función que se gatilla al hacer click en el elemento DIV */
    function sendForm() {
        console.log('send');
        $('input:checkbox').removeAttr('checked');
        $('textarea').val('')
        $('input[type="text"]').val('');
        $('input[type="email"]').val('');
        $('input[type="password"]').val('');
        alert('Su mensaje ha sido enviado con éxito');
    }

    function cancelForm() {
        console.log('cancel');
        $('input:checkbox').removeAttr('checked');
        $('textarea').val('')
        $('input[type="text"]').val('');
        $('input[type="email"]').val('');
        $('input[type="password"]').val('');
    }
});