<?php

session_start();

// Estos son los usuarios permitidos para hacer el Login
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
$recordarme = isset($_POST['recordarme']);

// Verificación para ver si están vacíos los campos
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

// Valido si el username empieza con un número
if (preg_match('/^\d/', $usu)) {
    header("Location: ../views/login.php?error=5"); // error=5 para nombre de usuario que empieza con un número
    exit;
}

// Verificar que el usuario existe y la contraseña es correcta
if (array_key_exists($usu, $usuarios_permitidos) && $usuarios_permitidos[$usu] === $pwd) {
    $_SESSION['usu'] = $usu;

    if ($recordarme) {
        // Mantener la cookie de usuario
        setcookie("usu", $usu, time() + (90 * 24 * 60 * 60), "/");

        // Si ya existe la cookie de última visita, mantenerla como está
        if (!isset($_COOKIE['ultima_visita'])) {
            setcookie("ultima_visita", date("Y-m-d H:i:s"), time() + (90 * 24 * 60 * 60), "/");
        }
    } else {
        // Eliminar cookies si existen
        setcookie("usu", "", time() - 3600, "/");
        setcookie("ultima_visita", "", time() - 3600, "/");
    }

    header("Location: ../views/perfil.php");
    exit;
} else {
    header("Location: ../views/login.php?error=1"); // Usuario o contraseña incorrectos
    exit;
}
