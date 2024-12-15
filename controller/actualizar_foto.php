<?php
session_start();
include_once '../controller/connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usu'])) {
    header("Location: ../views/login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$foto = $_FILES['foto'] ?? null;

// Validar la foto
$errores = [];
if ($foto && $foto['error'] === 0) {
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $extensiones_permitidas)) {
        $errores['foto'] = "Formato de foto no válido. Solo se permiten JPG, JPEG, PNG y GIF.";
    } else {
        if (!is_dir('../img/perfiles')) {
            mkdir('../img/perfiles', 0775, true);
        }

        $nuevoNombre = uniqid('perfil_', true) . '.' . $extension;
        $ruta_foto = '../img/perfiles/' . $nuevoNombre;

        if (!move_uploaded_file($foto['tmp_name'], $ruta_foto)) {
            error_log("Error al mover el archivo de la foto: " . print_r($foto, true));
            $errores['foto'] = "No se pudo subir la foto. Inténtalo de nuevo.";
        }
    }
} else {
    $errores['foto'] = "No se ha seleccionado ninguna foto o hubo un error al subirla.";
}

if (empty($errores)) {
    $query = "UPDATE usuarios SET Foto = ? WHERE IdUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nuevoNombre, $idUsuario);
    if ($stmt->execute()) {
        header("Location: ../views/perfil.php?success=1");
        exit();
    } else {
        error_log("Error al actualizar la foto en la base de datos: " . $stmt->error);
        $errores['general'] = "Error al actualizar la foto. Inténtalo más tarde.";
    }
}

// Si hay errores, redirigir de vuelta al perfil y mostrar los errores
$_SESSION['errores'] = $errores;
header("Location: ../views/perfil.php");
exit();

$stmt->close();
$conn->close();
