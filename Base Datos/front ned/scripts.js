// Ejemplo de validación básica
$('form').on('submit', function(e) {
    let email = $('#email').val();
    let password = $('#password').val();

    if (email === '' || password === '') {
        alert('Por favor, completa todos los campos');
        e.preventDefault();
    }
});
