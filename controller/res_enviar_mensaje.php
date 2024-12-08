<?php
session_start();

// Verificar si hay una sesión activa
if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
}

include_once "../controller/connect.php";

// Recoger los datos del formulario
$tipoMensaje = $_POST['tipo-mensaje'] ?? 0;
$mensaje = trim($_POST['mensaje'] ?? '');
$anuncio = $_POST['anuncio'] ?? 0;
$usuarioDestino = $_POST['usuario_destino'] ?? 0; // Se debe obtener del anuncio (propietario del anuncio)
$usuarioOrigen = $_SESSION['id_usuario'] ?? 0; // Usuario que está enviando el mensaje

// **Validar los datos del formulario**
$errores = [];

if (empty($tipoMensaje)) {
    $errores[] = "El tipo de mensaje es obligatorio.";
}

if (empty($mensaje)) {
    $errores[] = "El mensaje no puede estar vacío.";
}

if (empty($anuncio)) {
    $errores[] = "El anuncio no es válido.";
}

if (empty($usuarioDestino)) {
    $errores[] = "El destinatario no es válido.";
}

if (empty($usuarioOrigen)) {
    $errores[] = "El usuario origen no es válido.";
}

if (!empty($errores)) {
    // Mostrar errores y detener la ejecución
    echo "<h1>Errores en el envío del mensaje</h1>";
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo '<a href="javascript:history.back()">Volver</a>';
    exit();
}

// **Insertar el mensaje en la base de datos**
$query = "INSERT INTO mensajes (TMensaje, Texto, Anuncio, UsuarioOrigen, UsuarioDestino) 
          VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("isiii", $tipoMensaje, $mensaje, $anuncio, $usuarioOrigen, $usuarioDestino);

if ($stmt->execute()) {
    // Redirigir a la página de confirmación del mensaje
    header("Location: ../views/res_enviar_mensaje.php?tipo-mensaje=$tipoMensaje&mensaje=" . urlencode($mensaje));
    exit();
} else {
    echo "Error al enviar el mensaje: " . $stmt->error;
}

$stmt->close();
$conn->close();
