<?php
session_start();

$nombreUsuario = $_SESSION['usu'] ?? '';

// Verificar si existe la cookie de usuario y, en caso afirmativo, cargar los datos del usuario recordado
if (isset($_COOKIE['usu'])) {
    $nombreUsuario = $_COOKIE['usu'];
    $ultimaVisita = $_COOKIE['ultima_visita'] ?? 'Primera vez';

    // Actualizar la cookie de última visita con la fecha y hora actual
    setcookie("ultima_visita", date("Y-m-d H:i:s"), time() + (90 * 24 * 60 * 60), "/");
} else if (empty($nombreUsuario)) {
    // Si no hay sesión ni cookie, redirigir al inicio de sesión
    header("Location: login.php");
    exit;
} else {
    // Si solo hay sesión activa, pero no cookie de "recordarme"
    $ultimaVisita = "Primera vez";
}
?>
