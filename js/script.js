function compruebaOperacion(event, url){
  const confirmacion = confirm("¿Estás seguro de que deseas realizar esta acción?");
  
  if (confirmacion) {
    window.location.href = url;
  } else {
    event.preventDefault();
  }

}

function muestraTabla() {
  var display = window.getComputedStyle(
    document.getElementById("tabla")
  ).display;

  if (display == "block") {
    document.getElementById("tabla").style.display = "none";
  } else {
    document.getElementById("tabla").style.display = "block";
  }
}

function interiorTabla() {
  let base = 10,
    baseColor = 0,
    baseCalidad = 0,
    baseColorCalidad = 0;
  let costePagina = 0;
  let html = "";
  let interior = document.getElementById("interior");

    for(let i=1, j=3; i<=15||j<=45; i++){
        baseTotal=base;
        for(let k=1; k<=i; k++){
            if(k<5){
                costePagina=2;
            }
            else if(k>10){
                costePagina=1.6;
            }
            else{
                costePagina=1.8;
            }
            baseTotal = baseTotal + costePagina;
            
        }
        
        baseTotal = (baseTotal).toFixed(2);
        baseCalidad = (parseFloat(baseTotal) + j * 0.2).toFixed(2);
        baseColor = (parseFloat(baseTotal) + j * 0.5).toFixed(2);
        baseColorCalidad = (parseFloat(baseCalidad) + j * 0.5).toFixed(2);
        fila = document.createElement("tr");
        fila.innerHTML = `<td>${i} Paginas</td><td>${j} fotos</td><td>${baseTotal} €</td><td>${baseCalidad} €</td><td>${baseColor} €</td><td>${baseColorCalidad} €</td>`;

        interior.appendChild(fila);
        j=j+3
    }
}

function validarLogin(event) {
  event.preventDefault();
  limpiarErrores();

  const username = document.getElementById("usu").value.trim();
  const password = document.getElementById("pwd").value.trim();

  let hayErrores = false;

  // Validación de campos requeridos
  if (!username) {
    mostrarError("usu", "El nombre de usuario es requerido.");
    hayErrores = true;
  } else if (contieneEspaciosOTabs(username)) {
    mostrarError(
      "usu",
      "El nombre de usuario no puede contener espacios ni tabs."
    );
    hayErrores = true;
  }
  if (!email) {
    mostrarError("email", "El correo electrónico es requerido.");
    hayErrores = true;
  }
  if (!password) {
    mostrarError("pwd", "La contraseña es requerida.");
    hayErrores = true;
  } else if (contieneEspaciosOTabs(password)) {
    mostrarError("pwd", "La contraseña no puede contener espacios ni tabs.");
    hayErrores = true;
  }

  if (!hayErrores) {
    // Aquí puedes enviar el formulario o realizar alguna acción adicional
    alert("Formulario válido. Iniciando sesión...");
    // form.submit();
  }
}

// Función para verificar si la cadena contiene espacios o tabs
function contieneEspaciosOTabs(cadena) {
  for (let i = 0; i < cadena.length; i++) {
    if (cadena[i] === " " || cadena[i] === "\t") {
      return true;
    }
  }
  return false;
}

function validarFormularioRegistro(event) {
  event.preventDefault();
  limpiarErrores();

  const username = document.getElementById("usu").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("pwd").value.trim();
  const confirmaPassword = document.getElementById("pwd2").value.trim();
  const fechaNacimiento = document
    .getElementById("fecha_nacimiento")
    .value.trim();

  let hayErrores = false;

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
  if (
    username.length <= 3 ||
    username.length >= 15 ||
    !isNaN(username.charAt(0)) ||
    !esAlfanumerico(username)
  ) {
    mostrarError(
      "usu",
      "El nombre de usuario debe comenzar con una letra y tener entre 3 y 15 caracteres."
    );
    hayErrores = true;
  }

  // Validación de contraseña
  const tieneMayuscula = [...password].some(
    (char) => char === char.toUpperCase() && isNaN(char)
  );
  const tieneMinuscula = [...password].some(
    (char) => char === char.toLowerCase() && isNaN(char)
  );
  const tieneNumero = [...password].some((char) => !isNaN(char));

  if (
    password.length <= 6 ||
    password.length >= 15 ||
    !tieneMayuscula ||
    !tieneMinuscula ||
    !tieneNumero
  ) {
    mostrarError(
      "pwd",
      "La contraseña debe tener entre 6 y 15 caracteres, incluir una letra mayúscula, una minúscula y un número."
    );
    hayErrores = true;
  }

  // Validación de confirmación de contraseña
  if (password !== confirmaPassword) {
    mostrarError("pwd2", "Las contraseñas no coinciden.");
    hayErrores = true;
  }

  // Validación de email básica
  if (
    !email.includes("@") ||
    !email.includes(".") ||
    email.indexOf("@") === 0 ||
    email.indexOf(".") === email.length - 1 ||
    email.indexOf("@") > email.lastIndexOf(".") ||
    email.includes("ñ")
  ) {
    mostrarError("email", "El correo electrónico no es válido.");
    hayErrores = true;
  }

  // Validación de la fecha de nacimiento en texto (mayor de 18 años)
  const fechaValida = validarFechaNacimiento(fechaNacimiento);
  if (!fechaValida) {
    mostrarError(
      "fecha_nacimiento",
      "Debe tener al menos 18 años y la fecha debe estar en formato válido (YYYY-MM-DD)."
    );
    hayErrores = true;
  }

  if (!hayErrores) {
    alert("Formulario enviado correctamente");
    document.getElementById("registration-form").submit();
  }
}

// Función para validar que el nombre de usuario solo contiene letras y números
function esAlfanumerico(texto) {
  for (let i = 0; i < texto.length; i++) {
    const char = texto.charAt(i);
    if (
      !(
        (char >= "a" && char <= "z") ||
        (char >= "A" && char <= "Z") ||
        !isNaN(char)
      )
    ) {
      return false;
    }
  }
  return true;
}

// Función para validar fecha de nacimiento en formato texto (YYYY-MM-DD) y mayor de 18 años
function validarFechaNacimiento(fechaTexto) {
  const partes = fechaTexto.split("-");
  if (partes.length !== 3) return false;

  const year = parseInt(partes[0], 10);
  const month = parseInt(partes[1], 10) - 1; // Los meses en JS son 0 indexados
  const day = parseInt(partes[2], 10);

  const fechaNacimiento = new Date(year, month, day);
  const today = new Date();
  const age = today.getFullYear() - fechaNacimiento.getFullYear();
  const monthDifference = today.getMonth() - fechaNacimiento.getMonth();
  const dayDifference = today.getDate() - fechaNacimiento.getDate();

  return (
    (!isNaN(fechaNacimiento) && age > 18) ||
    (age === 18 &&
      (monthDifference > 0 || (monthDifference === 0 && dayDifference >= 0)))
  );
}

// Funciones de error y limpieza de errores (sin cambios)
function mostrarError(campoId, mensaje) {
  const campo = document.getElementById(campoId);
  const errorDiv = document.createElement("div");
  errorDiv.className = "error";
  errorDiv.innerText = mensaje;
  campo.classList.add("error-input");
  campo.parentNode.insertBefore(errorDiv, campo.nextSibling);
}

function limpiarErrores() {
  const mensajesDeError = document.querySelectorAll(".error");
  mensajesDeError.forEach((mensaje) => mensaje.remove());
  const camposConError = document.querySelectorAll(".error-input");
  camposConError.forEach((campo) => {
    campo.classList.remove("error-input");
  });
}

// Asignar el tipo de campo (solo "text")
function establecerTiposFormulario() {
    document.getElementById("usu").setAttribute("type", "text");
    document.getElementById("email").setAttribute("type", "text");
    document.getElementById("pwd").setAttribute("type", "text");
    document.getElementById("pwd2").setAttribute("type", "text");
    document.getElementById("fecha_nacimiento").setAttribute("type", "text");
    document.getElementById("foto_perfil").setAttribute("type", "text");
}


// formulario login

