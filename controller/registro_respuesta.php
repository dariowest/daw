<?php
// Procesar los datos del formulario y validar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $usuario = $_POST['usu'];
    $email = $_POST['email'];
    $contraseña = $_POST['pwd'];
    $confirmar_contraseña = $_POST['pwd2'];

    // array de errores
    $errores = [];

    // Validar nombre de usuario 
    if (empty($usuario)) {
        $errores['usu'] = "El nombre de usuario es obligatorio.";
    }

    // Validar correo electrónico
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "El correo electrónico no es válido.";
    }

    // Validar contraseña
    if (empty($contraseña) || strlen($contraseña) < 4) {
        $errores['pwd'] = "La contraseña debe tener al menos 4 caracteres.";
    }

    // Validar la confirmación de contraseña
    if ($contraseña !== $confirmar_contraseña) {
        $errores['pwd2'] = "Las contraseñas no coinciden.";
    }

    // Si no hay errores, redirigir al index_logeado.php con los datos
    if (empty($errores)) {
        // Preparar los datos a enviar a index_logeado.php
        $datos_usuario = [
            'usu' => $usuario,
            'email' => $email
        ];

        // Codificar los datos para pasarlos como parámetros en la URL
        // Redirigir a index_logeado.php pasando los datos
        header("Location: ../index.php");
        exit();
    } else {
        // Si hay errores, redirigir de vuelta al formulario de registro con los errores y datos
        header("Location: ../views/registro.php?errores=" . urlencode(json_encode($errores)) . "&data=" . urlencode(json_encode($_POST)));
        exit();
    }
}
?>
