<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no está ya activa
}

$nombreUsuario = $_SESSION['usu'] ?? '';

if (isset($_COOKIE['usu'])) {
    $nombreUsuario = $_COOKIE['usu'];
    $ultimaVisita = $_COOKIE['ultima_visita'] ?? 'Primera vez';
} else if (empty($nombreUsuario)) {
    header("Location: ../views/login.php"); // Redirige al login si no hay sesión ni cookie
    exit;
} else {
    $ultimaVisita = "Primera vez";
}
?>
