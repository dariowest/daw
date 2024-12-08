<?php
include_once "connect.php";
session_start();

$titulo = $_GET["titulo"];
$tipo = $_GET["tipo"];
$precio = $_GET["precio"];
$ciudad = $_GET["ciudad"];
$pais = $_GET["pais"];
$tipoVivienda = $_GET["tipoVivienda"];
$descripcion = $_GET["descripcion"];
$foto = $_GET["foto"];

// Validar si los valores están vacíos y asignar NULL si es necesario
$precio = empty($precio) ? "NULL" : "'" . addslashes($precio) . "'";
$foto = empty($foto) ? "NULL" : "'" . addslashes($foto) . "'";
$ciudad = empty($ciudad) ? "NULL" : "'" . addslashes($ciudad) . "'";

// Escapar los demás valores
$titulo = "'" . addslashes($titulo) . "'";
$tipo = "'" . addslashes($tipo) . "'";
$pais = "'" . addslashes($pais) . "'";
$tipoVivienda = "'" . addslashes($tipoVivienda) . "'";
$descripcion = "'" . addslashes($descripcion) . "'";
$usuario = $_SESSION['id_usuario'];

// Crear la consulta SQL
$sql = "INSERT INTO anuncios (TAnuncio, TVivienda, Foto, Titulo, Precio, Texto, Ciudad, Pais, Usuario) 
        VALUES ($tipo, $tipoVivienda, $foto, $titulo, $precio, $descripcion, $ciudad, $pais, $usuario)";

if ($conn->query($sql) === TRUE) {
    // Capturar el ID generado
    $idAnuncio = $conn->insert_id;
    header("Location: ../views/anuncio_foto.php?id=".$idAnuncio);
} else {
    echo "Error al crear el anuncio: " . $conn->error;
}


$conn->close();






?>