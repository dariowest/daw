<?php
// Definir usuarios permitidos
$usuarios_permitidos = [
    "usuario1" => "contrasena1",
    "usuario2" => "contrasena2",
    "usuario3" => "contrasena3",
    "usuario4" => "contrasena4",
    "usuario5" => "contrasena5"
];

// Obtener los datos enviados por el formulario
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';

// Validar si el nombre de usuario o la contraseña están vacíos
if (empty($usu) || empty($pwd)) {
    header("Location: ../views/login.php?error=3"); // error=3 para campos vacíos
    exit;
}

// Validar si el nombre de usuario o la contraseña contienen espacios en blanco
if (preg_match('/\s/', $usu) || preg_match('/\s/', $pwd)) {
    header("Location: ../views/login.php?error=2"); // error=2 para espacios en blanco
    exit;
}

// Validar si el nombre de usuario o la contraseña contienen caracteres no permitidos (ñ, tildes, etc.)
if (preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $usu) || preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $pwd)) {
    header("Location: ../views/login.php?error=4"); // error=4 para caracteres no permitidos
    exit;
}

// Verificar si el usuario y la contraseña son correctos
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
