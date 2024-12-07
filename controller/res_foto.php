<?php
$titulo = $_POST["titulo"];
$alternativo = $_POST["alternativo"];
$foto = $_POST["foto"];
$anuncio = $_POST["anuncio"];

include_once "connect.php";
$sql= "INSERT INTO fotos(Titulo, Fichero, Alternativo, Anuncio) VALUES('".$titulo."','".$foto."','".$alternativo."',".$anuncio.")";

$result = $conn->query($sql);
header('Location: ../views/anuncio.php?id='.$anuncio);



?>