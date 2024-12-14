<?php
session_start();
include_once '../controller/connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usu'])) {
    header("Location: ../views/login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$password = $_POST['password'] ?? '';

// Validar la contraseña
$query = "SELECT Clave FROM usuarios WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario || $password !== $usuario['Clave']) {
    $_SESSION['errores'] = "La contraseña no es correcta.";
    header("Location: ../views/confirmar_baja.php");
    exit();
}

// 1️⃣ **Eliminar fotos físicas asociadas al usuario**
$queryFotos = "SELECT Fichero FROM fotos WHERE Anuncio IN (SELECT IdAnuncio FROM anuncios WHERE Usuario = ?)";
$stmtFotos = $conn->prepare($queryFotos);
$stmtFotos->bind_param("i", $idUsuario);
$stmtFotos->execute();
$resultFotos = $stmtFotos->get_result();

while ($foto = $resultFotos->fetch_assoc()) {
    $rutaArchivo = '../img/' . $foto['Fichero'];
    if (file_exists($rutaArchivo)) {
        unlink($rutaArchivo); // Eliminar archivo físico
    }
}

// 2️⃣ **Eliminar registros de fotos asociadas a los anuncios del usuario**
$query = "DELETE FROM fotos WHERE Anuncio IN (SELECT IdAnuncio FROM anuncios WHERE Usuario = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

// 3️⃣ **Eliminar registros de anuncios del usuario**
$query = "DELETE FROM anuncios WHERE Usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

// 4️⃣ **Eliminar al usuario de la base de datos**
$query = "DELETE FROM usuarios WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

// Destruir la sesión
session_destroy();

// Redirigir al inicio
header("Location: ../views/login.php?success=baja");
exit();
