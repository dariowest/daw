<?php
include_once "connect.php";
session_start();
$sql = "SELECT Anuncio FROM Fotos WHERE IdFoto=".$_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $sql = "SELECT Usuario FROM anuncios WHERE IdAnuncio=".$row['Anuncio'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                if($row['Usuario']==$_SESSION['id_usuario']){
                    echo("Ejecuta");
                }
            }
        }

    }
}
?>