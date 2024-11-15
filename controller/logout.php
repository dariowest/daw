<?php
session_start();

// Guardar la hora actual como última visita
if (isset($_SESSION['usu'])) {
    setcookie("ultima_visita", date("Y-m-d H:i:s"), time() + (90 * 24 * 60 * 60), "/");
}

// Cerrar sesión y eliminar cookies
session_unset();
session_destroy();
setcookie("usu", "", time() - 3600, "/");

header("Location: ../views/login.php");
exit;
