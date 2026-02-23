
const urlbackend = "controllers/";
console.log("auth.js funcionando");
var loginButton = document.getElementById("login");
var usuario= document.getElementById("usuario");
var contrasena= document.getElementById("contrasena");
//un lenguaje de eventos
loginButton.addEventListener("click", function() {
    //login(email.value, password.value);
    event.preventDefault(); // Evita que el formulario se envíe de manera tradicional
    console.log("login");
    console.log(usuario.value);
    console.log(contrasena.value);
    login(usuario.value, contrasena.value);
});

function login(usuario, contrasena) {

    fetch(urlbackend + "auth.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: 'login',
            usuario: usuario,
            contrasena: contrasena
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            console.log("Login exitoso");
            // Redirigir a la página de inicio
                window.location.href = "dashboard.php";
            
            
        } else {
            console.log("Error al iniciar sesión");

        }
    })
    .catch(error => {
        console.log(error);
    });

}