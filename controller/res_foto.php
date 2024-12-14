<?php
session_start();
include_once '../controller/connect.php';

if (!isset($_SESSION['usu'])) {
    header("Location: ../views/login.php");
    exit();
}

$idUsuario = $_SESSION['id_usuario'];
$idAnuncio = $_POST['anuncio'] ?? 0;
$titulo = trim($_POST['titulo'] ?? '');
$alternativo = trim($_POST['alternativo'] ?? '');
$foto = $_FILES['foto'] ?? null;

$errores = [];

// 🛠️ **Validaciones**
if (empty($idAnuncio)) {
    $errores[] = "Debes seleccionar un anuncio.";
}

if (empty($titulo)) {
    $errores[] = "El título no puede estar vacío.";
}

if (strlen($alternativo) < 10) {
    $errores[] = "El texto alternativo debe tener al menos 10 caracteres.";
}

if ($foto && $foto['error'] === 0) {
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $extensionesPermitidas)) {
        $errores[] = "Formato de imagen no permitido. Solo se aceptan JPG, JPEG, PNG y GIF.";
    }

    if ($foto['size'] > 5 * 1024 * 1024) {
        $errores[] = "El tamaño máximo permitido para la imagen es de 5 MB.";
    }

    $nuevoNombre = uniqid('foto_', true) . '.' . $extension; // Nombre único
} else {
    $errores[] = "Error al subir la imagen. Inténtalo de nuevo.";
}

if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    header("Location: ../views/anuncio_foto.php");
    exit();
}

// 🛠️ **Subir la imagen al servidor**
if (move_uploaded_file($foto['tmp_name'], '../img/' . $nuevoNombre)) {
    // Insertar la información de la foto en la base de datos
    $query = "INSERT INTO fotos (Titulo, Alternativo, Fichero, Anuncio) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $titulo, $alternativo, $nuevoNombre, $idAnuncio);

    if ($stmt->execute()) {
        header("Location: ../views/anuncio.php?id=$idAnuncio&success=1");
    } else {
        $_SESSION['errores'][] = "Error al insertar la foto en la base de datos.";
        header("Location: ../views/anuncio_foto.php");
    }
} else {
    $_SESSION['errores'][] = "Error al mover la imagen al servidor.";
    header("Location: ../views/anuncio_foto.php");
}

$stmt->close();
$conn->close();
