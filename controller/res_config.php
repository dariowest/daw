<?php
//UPDATE `usuarios` SET `Estilo`= 5 WHERE `IdUsuario` = 1;
include_once ("connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['id_usuario'])){
    $sql = "UPDATE usuarios SET Estilo = ".$_POST['est']." WHERE IdUsuario = ".$_SESSION['id_usuario'];
    $result = $conn->query($sql);
    header("Location: ../views/config.php");


}
else{
    header("Location: ../index.php");
}
?>