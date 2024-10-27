function tipoFolleto(){
    console.log("Hola");
    document.getElementById("fecha").setAttribute('type', 'date');
    document.getElementById("reso").setAttribute('type', 'number');
    document.getElementById("copias").setAttribute('type', 'number');
    document.getElementById("color").setAttribute('type', 'color');
    document.getElementById("radio1").setAttribute('type', 'radio');
    document.getElementById("radio2").setAttribute('type', 'radio');
    document.getElementById("telefono").setAttribute('type', 'tel');
    document.getElementById("numero").setAttribute('type', 'number');
    document.getElementById("cp").setAttribute('type', 'number');
    document.getElementById("Email").setAttribute('type', 'email');

    document.getElementById("adicional").setAttribute('type', 'text');
    document.getElementById("nombre").setAttribute('type', 'text');
    document.getElementById("calle").setAttribute('type', 'text');

}

function muestraTabla(){
    var display = window.getComputedStyle(document.getElementById('tabla')).display;

    if(display=="block"){
        document.getElementById('tabla').style.display = 'none';

    }
    else{
        document.getElementById('tabla').style.display = 'block';

    }
    

}

function interiorTabla(){
    let base=10, baseTotal=0, baseColor=0, baseCalidad=0, baseColorCalidad=0;
    let costePagina=0;
    let html="";
    let interior = document.getElementById("interior");

    for(let i=1, j=3; i<=15||j<=45; i++){
        if(i<5){
            costePagina=2;
        }
        else if(i>10){
            costePagina=1.6;
        }
        else{
            costePagina=1.8;
        }
        baseTotal = (base + costePagina * i).toFixed(2);
        baseCalidad = (parseFloat(baseTotal) + j * 0.2).toFixed(2);
        baseColor = (parseFloat(baseTotal) + j * 0.5).toFixed(2);
        baseColorCalidad = (parseFloat(baseCalidad) + j * 0.5).toFixed(2);

        html += `<tr><td>${i} Paginas</td><td>${j} fotos</td><td>${baseTotal} €</td><td>${baseCalidad} €</td><td>${baseColor} €</td><td>${baseColorCalidad} €</td></tr>`;



        
        
        j=j+3
    }
    interior.innerHTML=html;
}


function validarFormularioRegistro(event) {
    // Evitar el envío del formulario hasta que se validen los campos
    event.preventDefault();

    // Limpiar mensajes de error previos
    limpiarErrores();

    // Obtener los valores de los campos
    const username = document.getElementById("usu").value.trim(); // Trim para quitar espacios
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("pwd").value.trim();
    const confirmaPassword = document.getElementById("pwd2").value.trim();
    const fechaNacimiento = document.getElementById("fecha_nacimiento").value.trim();

    let hayErrores = false; // Flag para verificar si hay errores

    // Validación de campos requeridos
    if (!username) {
        mostrarError("usu", "El nombre de usuario es requerido.");
        hayErrores = true;
    }

    if (!email) {
        mostrarError("email", "El correo electrónico es requerido.");
        hayErrores = true;
    }

    if (!password) {
        mostrarError("pwd", "La contraseña es requerida.");
        hayErrores = true;
    }

    if (!confirmaPassword) {
        mostrarError("pwd2", "La confirmación de contraseña es requerida.");
        hayErrores = true;
    }

    if (!fechaNacimiento) {
        mostrarError("fecha_nacimiento", "La fecha de nacimiento es requerida.");
        hayErrores = true;
    }

    // Validación de username
    const usernameRegex = /^[a-zA-Z][a-zA-Z0-9]{2,14}$/;
    if (!usernameRegex.test(username)) {
        mostrarError("usu", "El nombre de usuario debe comenzar con una letra, tener entre 3 y 15 caracteres, y solo puede contener letras y números.");
        hayErrores = true; // Indicar que hay un error
    }

    // Validación de contraseña
    const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d_-]{6,15}$/;
    if (!passRegex.test(password)) {
        mostrarError("pwd", "La contraseña debe tener entre 6 y 15 caracteres, al menos una letra mayúscula, una minúscula y un número. Solo se permiten letras, números, guiones y guiones bajos.");
        hayErrores = true;
    }

    // Validación de la confirmación de contraseña
    if (password !== confirmaPassword) {
        mostrarError("pwd2", "Las contraseñas no coinciden.");
        hayErrores = true;
    }

    // Validación del email
    const emailRegex = /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~.-]{1,64}@[a-zA-Z0-9-]{1,63}(\.[a-zA-Z0-9-]{1,63}){1,}$/;
    if (!emailRegex.test(email) || email.length > 254) {
        mostrarError("email", "El correo electrónico no es válido o excede los 254 caracteres.");
        hayErrores = true;
    }

    // Validación de la fecha de nacimiento (mayor de 18 años)
    const fechaNacimientoObj = new Date(fechaNacimiento);
    const today = new Date();
    const age = today.getFullYear() - fechaNacimientoObj.getFullYear();
    const monthDifference = today.getMonth() - fechaNacimientoObj.getMonth();
    const dayDifference = today.getDate() - fechaNacimientoObj.getDate();

    if (
        isNaN(fechaNacimientoObj) ||
        age < 18 ||
        (age === 18 && monthDifference < 0) ||
        (age === 18 && monthDifference === 0 && dayDifference < 0)
    ) {
        mostrarError("fecha_nacimiento", "Debe tener al menos 18 años.");
        hayErrores = true;
    }

    // Si no hay errores, se puede enviar el formulario
    if (!hayErrores) {
        alert("Formulario enviado correctamente");
        document.getElementById("registration-form").submit();
    }
}

// Función para mostrar el error al lado del campo
function mostrarError(campoId, mensaje) {
    const campo = document.getElementById(campoId);
    const errorDiv = document.createElement("div");
    errorDiv.className = "error"; // Asegúrate de tener un estilo CSS para los mensajes de error
    errorDiv.innerText = mensaje;

    // Agregar clase de error al campo
    campo.classList.add("error-input");

    campo.parentNode.insertBefore(errorDiv, campo.nextSibling);
}

// Función para limpiar mensajes de error anteriores
function limpiarErrores() {
    const mensajesDeError = document.querySelectorAll(".error");
    mensajesDeError.forEach((mensaje) => mensaje.remove());

    // Limpiar clase de error en los campos
    const camposConError = document.querySelectorAll(".error-input");
    camposConError.forEach((campo) => {
        campo.classList.remove("error-input");
    });
}

// Función para establecer el tipo de cada campo del formulario
function establecerTiposFormulario() {
    document.getElementById("usu").setAttribute("type", "text"); // Nombre de usuario
    document.getElementById("email").setAttribute("type", "email"); // Correo electrónico
    document.getElementById("pwd").setAttribute("type", "password"); // Contraseña
    document.getElementById("pwd2").setAttribute("type", "password"); // Confirmación de contraseña
    document.getElementById("fecha_nacimiento").setAttribute("type", "date"); // Fecha de nacimiento
    document.getElementById("foto_perfil").setAttribute("type", "file"); // Foto de perfil
}

// Ejecutar la función cuando el DOM esté completamente cargado

