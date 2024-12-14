<?php
session_start();
include_once '../controller/connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usu'])) {
    header("Location: ../views/login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');

// Validar los datos
$errores = [];

// Validar nombre de usuario
if (empty($nombre) || !preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,14}$/', $nombre)) {
    $errores['nombre'] = "El nombre de usuario debe comenzar con una letra, tener entre 3 y 15 caracteres, y solo letras o números.";
}

// Validar correo electrónico
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores['email'] = "El correo electrónico no es válido.";
}

if (empty($errores)) {
    $query = "UPDATE usuarios SET NomUsuario = ?, Email = ? WHERE IdUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $nombre, $email, $idUsuario);
    if ($stmt->execute()) {
        header("Location: ../views/perfil.php?success=1");
        exit();
    } else {
        error_log("Error al actualizar los datos del usuario: " . $stmt->error);
        $errores['general'] = "Error al actualizar los datos. Inténtalo más tarde.";
    }
}

// Si hay errores, redirigir de vuelta al perfil y mostrar los errores
$_SESSION['errores'] = $errores;
header("Location: ../views/perfil.php");
exit();

$stmt->close();
$conn->close();
