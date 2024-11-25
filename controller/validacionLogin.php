<?php
session_start();

// Leer configuración desde config.ini

// Conectar a la base de datos
$mysqli = new mysqli(
    $config['DB']['Server'],
    $config['DB']['User'],
    $config['DB']['Password'],
    $config['DB']['Database']
);

// Comprobar conexión
if ($mysqli->connect_error) {
    die("Error al conectar a la base de datos: " . $mysqli->connect_error);
}

// Obtener los datos del formulario
$usu = $_POST['usu'] ?? '';
$pwd = $_POST['pwd'] ?? '';
$recordarme = isset($_POST['recordarme']);

// Validaciones previas
if (empty($usu) || empty($pwd)) {
    header("Location: ../views/login.php?error=3"); // Campos vacíos
    exit;
}

if (preg_match('/\s/', $usu) || preg_match('/\s/', $pwd)) {
    header("Location: ../views/login.php?error=2"); // Espacios en blanco
    exit;
}

if (preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $usu) || preg_match('/[ñÑáéíóúÁÉÍÓÚ]/', $pwd)) {
    header("Location: ../views/login.php?error=4"); // Caracteres no permitidos
    exit;
}

if (preg_match('/^\d/', $usu)) {
    header("Location: ../views/login.php?error=5"); // Usuario inicia con número
    exit;
}

// Consultar la base de datos para verificar usuario y contraseña
$query = "SELECT * FROM Usuarios WHERE NomUsuario = ? AND Clave = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $usu, $pwd);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
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
    // Usuario o contraseña incorrectos
    header("Location: ../views/login.php?error=1");
    exit;
}

$stmt->close();
$mysqli->close();
?>