<?php
// Recibo los datos del formulario (he puesto para que si el usuario no pone un dato, salga uno por defecto)
$textoAdicional = $_POST['textoAdicional'] ?? 'Anuncio destacado para propiedad de lujo en el centro de Málaga';
$nombre = $_POST['nombre'] ?? 'Nombre por defecto';
$email = $_POST['email'] ?? 'emailinventado@mail.com';
$calle = $_POST['calle'] ?? 'calle al azar';
$numeroCalle = $_POST['numero'] ?? '0';
$cp = $_POST['cp'] ?? '00000';
$localidad = $_POST['localidad'] ?? 'Ciudad';
$direccion = $calle . ", " . $numeroCalle . ", " . $cp . ", " . $localidad;
$telefono = $_POST['telefono'] ?? '+34 666 66 66 66';
$colorPortada = $_POST['colorPortada'] ?? '#FF5733';
$numCopias = (int)($_POST['numCopias'] ?? 50);
$resolucion = (int)($_POST['resolucion'] ?? 600);
$anuncio = $_POST['anuncio'] ?? 'anuncio 1';
$fecha_recepcion = $_POST['fechaRecepcion'] ?? '01/01/2024';
$modoImpresion = $_POST['modoImpresion'] ?? 'tipoImpresion';

// valores estáticos
$numPaginas = 8;
$numFotos = 10;

// Tarifas
$tarifaPagina = 1.8; // Euros por página
$tarifaFotoColor = 0.5; // Euros por foto en color
$tarifaFotoResolucionAlta = 0.2; // Euros extra por foto de alta resolución (>300 dpi)
$costeEnvio = 10; // Coste fijo de procesamiento y envío

// Calcular el coste del folleto
$costePaginas = $numPaginas * $tarifaPagina;
$costeFotos = $numFotos * ($tarifaFotoColor + ($resolucion > 300 ? $tarifaFotoResolucionAlta : 0));
$precioUnitario = $costePaginas + $costeFotos + $costeEnvio;
$costeTotal = $precioUnitario * $numCopias;
?>
