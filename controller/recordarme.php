<?php
session_start();

$nombreUsuario = $_SESSION['usu'] ?? '';

if (isset($_COOKIE['usu'])) {
    $nombreUsuario = $_COOKIE['usu'];
    $ultimaVisita = $_COOKIE['ultima_visita'] ?? 'Primera vez';
} else if (empty($nombreUsuario)) {
    header("Location: ../views/login.php");
    exit;
} else {
    $ultimaVisita = "Primera vez";
}
?>
