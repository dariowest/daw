<?php
session_start();

// Leer configuración desde config.ini
include_once "../controller/connect.php";

// Obtener los datos del formulario
$usu = trim($_POST['usu'] ?? '');
$pwd = $_POST['pwd'] ?? '';
$recordarme = isset($_POST['recordarme']);

// Validaciones previas
if (empty($usu) || empty($pwd)) {
    header("Location: ../views/login.php?error=3"); // Campos vacíos
    exit;
}

// Consultar la base de datos para verificar usuario
$query = "SELECT * FROM Usuarios WHERE NomUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usu);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Mostrar depuración (eliminar en producción)
    error_log("DEBUG: Usuario encontrado: " . print_r($usuario, true));

    // Compara la contraseña en texto plano
    if ($pwd === $usuario['Clave']) {
        $_SESSION['usu'] = $usuario['NomUsuario']; // Guardar nombre de usuario en la sesión
        $_SESSION['id_usuario'] = $usuario['IdUsuario']; // Guardar ID del usuario en la sesión

        if ($recordarme) {
            // Configurar cookies si el usuario eligió "recordarme"
            setcookie("usu", $usuario['NomUsuario'], time() + (90 * 24 * 60 * 60), "/");
            setcookie("ultima_visita", date("Y-m-d H:i:s"), time() + (90 * 24 * 60 * 60), "/");
        }

        // Redirigir al perfil del usuario
        header("Location: ../views/perfil.php");
        exit;
    } else {
        // Contraseña incorrecta
        error_log("DEBUG: Contraseña incorrecta para el usuario: " . $usu);
        header("Location: ../views/login.php?error=1");
        exit;
    }
} else {
    // Usuario no encontrado
    error_log("DEBUG: Usuario no encontrado: " . $usu);
    header("Location: ../views/login.php?error=1");
    exit;
}

$stmt->close();
$conn->close();
