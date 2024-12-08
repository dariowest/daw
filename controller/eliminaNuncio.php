<?php
include_once "connect.php";
session_start();

$sql = "SELECT Usuario FROM anuncios WHERE IdAnuncio=".$_GET['id'];
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        if($row['Usuario']==$_SESSION['id_usuario']){
            $sql= "DELETE FROM fotos WHERE Anuncio = ".$_GET['id'];
            $result = $conn->query($sql);
            $sql= "DELETE FROM anuncios WHERE IdAnuncio = ".$_GET['id'];
            $result = $conn->query($sql);
            header("Location: ../views/mis_anuncios.php");
        }
    }
}
?>
