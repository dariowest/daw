<?php
session_start();
include_once '../controller/connect.php';

$idUsuario = $_SESSION['id_usuario'];

// Obtener la foto actual
$query = "SELECT Foto FROM usuarios WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$fotoActual = $usuario['Foto'];
if ($fotoActual !== 'default.png' && file_exists('../img/perfiles/' . $fotoActual)) {
    unlink('../img/perfiles/' . $fotoActual);
}

$query = "UPDATE usuarios SET Foto = 'default.png' WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

header("Location: ../views/perfil.php");
exit();
