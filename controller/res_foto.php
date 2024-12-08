<?php
$titulo = $_POST["titulo"];
$alternativo = $_POST["alternativo"];
$foto = $_POST["foto"];
$anuncio = $_POST["anuncio"];

include_once "connect.php";

// Verificar si $alternativo contiene "imagen" o "foto" (insensible a mayúsculas)
if (stripos($alternativo, 'imagen') !== false || stripos($alternativo, 'foto') !== false) {
    // Si contiene "imagen" o "foto", no ejecutar la consulta y redirigir
    header('Location: ../views/anuncio.php?id='.$anuncio.'&error=3');
    exit;
}

// Crear y ejecutar la consulta SQL si no se detectó "imagen" o "foto"
$sql = "INSERT INTO fotos (Titulo, Fichero, Alternativo, Anuncio) 
        VALUES ('".$titulo."', '".$foto."', '".$alternativo."', ".$anuncio.")";

if ($conn->query($sql) === TRUE) {
    header('Location: ../views/anuncio.php?id='.$anuncio);
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

$conn->close();
?>