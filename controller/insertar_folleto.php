<?php
session_start();
include_once '../controller/connect.php';

// Validar los datos del formulario
$anuncio = $_POST['anuncio'] ?? 0;
$textoAdicional = $_POST['textoAdicional'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$direccion = trim($_POST['calle'] . ' ' . $_POST['numero'] . ' ' . $_POST['cp'] . ' ' . $_POST['localidad']);
$telefono = $_POST['telefono'] ?? '';
$colorPortada = $_POST['colorPortada'] ?? '';
$numCopias = $_POST['numCopias'] ?? 0;
$resolucion = $_POST['resolucion'] ?? 0;
$fechaRecepcion = trim($_POST['fechaRecepcion'] ?? ''); // Usamos trim para quitar espacios extra
$modoImpresion = $_POST['tipoImpresion'] ?? 'Blanco y negro';
$icolor = $modoImpresion === 'Color' ? 1 : 0;

// Validar y formatear la fecha de recepción
if (!empty($fechaRecepcion)) {
    // Validar formato correcto (YYYY-MM-DD)
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaRecepcion)) {
        try {
            $fechaObj = DateTime::createFromFormat('Y-m-d', $fechaRecepcion);
            if ($fechaObj && $fechaObj->format('Y-m-d') === $fechaRecepcion) {
                $fechaRecepcion = $fechaObj->format('Y-m-d');
            } else {
                $fechaRecepcion = null; // Fecha no válida
            }
        } catch (Exception $e) {
            $fechaRecepcion = null; // Error al convertir la fecha
        }
    } else {
        $fechaRecepcion = null; // No coincide con el formato YYYY-MM-DD
    }
} else {
    $fechaRecepcion = null; // Si la fecha está vacía, la dejamos en NULL
}

// Validar otros campos
if (empty($anuncio) || empty($nombre) || empty($email)) {
    die('Error: Datos requeridos están vacíos.');
}

// Calcular el coste (debes ajustar esto a la lógica de precios que tengas)
$coste = 10 + ($numCopias * 2); // Ejemplo simple

// Preparar la consulta para insertar en la base de datos
$query = "INSERT INTO solicitudes 
    (Anuncio, Texto, Nombre, Email, Direccion, Telefono, Color, Copias, Resolucion, Fecha, IColor, IPrecio, Coste) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "issssssiiisid", // Definir los tipos de los parámetros
    $anuncio,
    $textoAdicional,
    $nombre,
    $email,
    $direccion,
    $telefono,
    $colorPortada,
    $numCopias,
    $resolucion,
    $fechaRecepcion,
    $icolor,
    $icolor, // Ejemplo de tarifa por impresión (0 o 1, según sea color o no)
    $coste
);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Guardar el ID de la solicitud insertada en $_SESSION
    $_SESSION['ultima_solicitud_id'] = $conn->insert_id;
    header("Location: ../views/folleto.php");
    exit();
} else {
    echo "Error al registrar la solicitud: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
