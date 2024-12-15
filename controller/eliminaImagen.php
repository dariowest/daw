<?php
include_once "connect.php";
session_start();
$sql = "SELECT Anuncio FROM fotos WHERE IdFoto=".$_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $sql = "SELECT Usuario FROM anuncios WHERE IdAnuncio=".$row['Anuncio'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                if($row['Usuario']==$_SESSION['id_usuario']){
                    $sqlFotos = "SELECT Fichero FROM fotos WHERE idFoto = ".$_GET['id'];
                    $resultFotos = $conn->query($sqlFotos);
                    
                    if ($resultFotos->num_rows > 0) {
                        while ($foto = $resultFotos->fetch_assoc()) {
                            $ruta="../img/".$foto['Fichero'];
                            if (file_exists($ruta)){
                                unlink($ruta);
                            }
                        }
                    }

                    $sql= "DELETE FROM fotos WHERE IdFoto = ".$_GET['id'];
                    $result = $conn->query($sql);
                    header("Location: ../views/mis_anuncios.php");
                }
            }
        }

    }
}
?>