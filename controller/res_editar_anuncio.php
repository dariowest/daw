<?php
include_once "connect.php";
session_start();

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$precio = $_POST["precio"];
$tipo = $_POST["tipo"];
$ciudad = $_POST["ciudad"];
$pais = $_POST["pais"];
$tipoVivienda = $_POST["tipoVivienda"];
$descripcion = $_POST["descripcion"];
$Nhabitaciones = $_POST["habitaciones"];
$Nbanyos = $_POST["banyo"];
$Plantas = $_POST["planta"];

$sql = "UPDATE anuncios SET TAnuncio=$tipo, TVivienda=$tipoVivienda, Titulo='$titulo', Precio=$precio, Texto='$descripcion', Ciudad='$ciudad', Pais=$pais, Nhabitaciones=$Nhabitaciones, Nbanyos=$Nbanyos, Planta=$Plantas WHERE IdAnuncio=$id";

$result = $conn->query($sql);

header("Location: ../views/anuncio.php?id=".$id);

?>