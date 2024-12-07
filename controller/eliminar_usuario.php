<?php
session_start();
include_once '../controller/connect.php';

// Verificar sesión activa
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$password = $_POST['password'] ?? '';

// Verificar la contraseña del usuario
$query = "SELECT Clave FROM Usuarios WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario || $usuario['Clave'] !== $password) {
    // Contraseña incorrecta
    header("Location: ../views/confirmar_baja.php?error=1");
    exit();
}

// Eliminar anuncios y fotos relacionados con el usuario
$conn->begin_transaction();
try {
    $stmt = $conn->prepare("DELETE FROM Fotos WHERE Anuncio IN (SELECT IdAnuncio FROM Anuncios WHERE Usuario = ?)");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM Anuncios WHERE Usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM Usuarios WHERE IdUsuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();

    $conn->commit();

    // Destruir la sesión y redirigir al inicio
    session_destroy();
    header("Location: ../index.php?success=1");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    error_log("Error al eliminar usuario: " . $e->getMessage());
    header("Location: ../views/confirmar_baja.php?error=2");
    exit();
}
?>
