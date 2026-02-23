const urlbackend = "controllers/";
var loginButton = document.getElementById("login");
var usuario= document.getElementById("usuario");
var contrasena= document.getElementById("contrasena");
var message = document.getElementById("message");
//un lenguaje de eventos
loginButton.addEventListener("click", function() {
    //login(email.value, password.value);
    event.preventDefault(); // Evita que el formulario se envíe de manera tradicional
    console.log("login");
    console.log(usuario.value);
    console.log(contrasena.value);
    login(usuario.value, contrasena.value);
});

const buttonsalir = document.getElementById("logout");
buttonsalir.addEventListener("click", () => {
  event.preventDefault(); // Evita que el formulario se envíe
  fetch(urlbackend + "auth.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      action: 'logout'
    })
  })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      window.location.href = "index.html";
    })
    .catch(error => {
      console.error('Error:', error);
    });
  return false; // Evita que el formulario se envíe
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
            message.textContent = "login fallido,intentelo de nuevo";
            message.classList.add("error");
        }
    })
    .catch(error => {
        console.log(error);
    });

}