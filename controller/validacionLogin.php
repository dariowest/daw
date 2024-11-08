<?php
//Estos son los usuarios permitidos para hacer el Login
$usuarios_permitidos = [
    "usuario1" => "contrasena1",
    "usuario2" => "contrasena2",
    "usuario3" => "contrasena3",
    "usuario4" => "contrasena4",
    "usuario5" => "contrasena5"
];

// Obtengo los datos que me da el formulario
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';

// Verificación para ver si están vacios los campos
if (empty($usu) || empty($pwd)) {
    header("Location: ../views/login.php?error=3"); // error=3 para campos vacíos
    exit;
}

// Verifico si hay espacios en blanco en los campos ingresados
if (preg_match('/\s/', $usu) || preg_match('/\s/', $pwd)) {
    header("Location: ../views/login.php?error=2"); // error=2 para espacios en blanco
    exit;
}

// Verifico que no hayan caracteres especiales tanto en usuario como en contraseña
if (preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $usu) || preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $pwd)) {
    header("Location: ../views/login.php?error=4"); // error=4 para caracteres no permitidos
    exit;
}

// Valido si el username empieza con un número y nonono
if (preg_match('/^\d/', $usu)) {
    header("Location: ../views/login.php?error=5"); // error=5 para nombre de usuario que empieza con un número
    exit;
}

// Con esta verificación veo si el user y contra es válido.
if (array_key_exists($usu, $usuarios_permitidos) && $usuarios_permitidos[$usu] === $pwd) {
    // Si las credenciales son correctas
    session_start();
    $_SESSION['usu'] = $usu;
    header("Location: ../views/perfil.html");
    exit;
} else {
    // Si las credenciales son incorrectas
    header("Location: ../views/login.php?error=1"); // error=1 para usuario/contraseña incorrectos
    exit;
}