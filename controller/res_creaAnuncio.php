<?php
include_once "connect.php";
session_start();

$titulo = trim($_POST["titulo"] ?? '');
$tipo = $_POST["tipo"] ?? null;
$precio = $_POST["precio"] ?? null;
$ciudad = trim($_POST["ciudad"] ?? '');
$pais = $_POST["pais"] ?? null;
$tipoVivienda = $_POST["tipoVivienda"] ?? null;
$descripcion = trim($_POST["descripcion"] ?? '');
$foto = $_FILES['foto'] ?? null;

// Validar y subir la foto
$foto_nombre = null;
if ($foto && $foto['error'] === 0) {
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    
    if (in_array($extension, $extensiones_permitidas)) {
        if (!is_dir('../img/anuncios')) {
            mkdir('../img/anuncios', 0775, true);
        }
        
        $foto_nombre = uniqid('anuncio_', true) . '.' . $extension;
        $ruta_foto = '../img/anuncios/' . $foto_nombre;

        if (!move_uploaded_file($foto['tmp_name'], $ruta_foto)) {
            error_log("Error al mover la imagen del anuncio");
        }
    } else {
        error_log("Extensión no permitida para la foto");
    }
}

$usuario = $_SESSION['id_usuario'];

// Crear la consulta SQL
$query = "INSERT INTO anuncios (TAnuncio, TVivienda, Foto, Titulo, Precio, Texto, Ciudad, Pais, Usuario) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iissssssi", $tipo, $tipoVivienda, $foto_nombre, $titulo, $precio, $descripcion, $ciudad, $pais, $usuario);

if ($stmt->execute()) {
    $idAnuncio = $conn->insert_id;
    header("Location: ../views/anuncio_foto.php?id=".$idAnuncio);
} else {
    error_log("Error al crear el anuncio: " . $stmt->error);
    echo "Error al crear el anuncio.";
}

$stmt->close();
$conn->close();
