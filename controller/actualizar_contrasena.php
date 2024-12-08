<?php
session_start();
include_once '../controller/connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usu'])) {
    header("Location: ../views/login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$pwdActual = $_POST['password_actual'] ?? '';
$pwdNueva = $_POST['password_nueva'] ?? '';
$pwdConfirmar = $_POST['password_confirmar'] ?? '';

// Validar los datos
$errores = [];

// Validar la contraseña actual
if (empty($pwdActual)) {
    $errores['password_actual'] = "La contraseña actual no puede estar vacía.";
}

// Validar nueva contraseña
if (empty($pwdNueva) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d_-]{6,15}$/', $pwdNueva)) {
    $errores['password_nueva'] = "La nueva contraseña debe tener entre 6 y 15 caracteres, incluir una mayúscula, una minúscula y un número.";
}

// Confirmar nueva contraseña
if ($pwdNueva !== $pwdConfirmar) {
    $errores['password_confirmar'] = "Las contraseñas no coinciden.";
}

if (empty($errores)) {
    // Verificar la contraseña actual en la base de datos
    $query = "SELECT Clave FROM usuarios WHERE IdUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && $pwdActual === $usuario['Clave']) {
        // Actualizar la contraseña en la base de datos (sin hash, como lo solicitaste)
        $queryUpdate = "UPDATE usuarios SET Clave = ? WHERE IdUsuario = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param("si", $pwdNueva, $idUsuario);
        
        if ($stmtUpdate->execute()) {
            header("Location: ../views/perfil.php?success=1");
            exit();
        } else {
            $errores['general'] = "Error al actualizar la contraseña. Inténtelo más tarde.";
        }
    } else {
        $errores['password_actual'] = "La contraseña actual no es correcta.";
    }
}

// Si hay errores, redirigir de vuelta al perfil y mostrar los errores
$_SESSION['errores'] = $errores;
header("Location: ../views/perfil.php");
exit();

$stmt->close();
$conn->close();
