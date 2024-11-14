<?php
// Recibo los datos del formulario (con valores por defecto si están vacíos)
$textoAdicional = !empty($_POST['textoAdicional']) ? $_POST['textoAdicional'] : 'Anuncio destacado para propiedad de lujo en el centro de Málaga';
$nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : 'Nombre por defecto';
$email = !empty($_POST['email']) ? $_POST['email'] : 'emailinventado@mail.com';
$calle = !empty($_POST['calle']) ? $_POST['calle'] : 'calle al azar';
$numeroCalle = !empty($_POST['numero']) ? $_POST['numero'] : '0';
$cp = !empty($_POST['cp']) ? $_POST['cp'] : '00000';
$localidad = !empty($_POST['localidad']) ? $_POST['localidad'] : 'Ciudad';
$direccion = $calle . ", " . $numeroCalle . ", " . $cp . ", " . $localidad;
$telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : '+34 666 66 66 66';
$colorPortada = !empty($_POST['colorPortada']) ? $_POST['colorPortada'] : '#FF5733';
$numCopias = !empty($_POST['numCopias']) ? (int)$_POST['numCopias'] : 50;
$resolucion = !empty($_POST['resolucion']) ? (int)$_POST['resolucion'] : 300;
$anuncio = !empty($_POST['anuncio']) ? $_POST['anuncio'] : 'anuncio 1';
$fecha_recepcion = !empty($_POST['fechaRecepcion']) ? $_POST['fechaRecepcion'] : '01/01/2024';
$modoImpresion = !empty($_POST['tipoImpresion']) ? $_POST['tipoImpresion'] : 'Blanco y negro';

// Valores estáticos
$numPaginas = 9;
$numFotos = 27;

// Tarifa según la tabla de precios
$tarifas = [
    'Blanco y negro' => [
        '150-300 dpi' => [12, 14, 16, 18, 19.8, 21.6, 23.4, 25.2, 27, 28.8, 30.6, 33, 33.6, 35.2, 36.8],
        '450-900 dpi' => [12.6, 15.2, 17.8, 20.4, 22.8, 25.2, 27.6, 30, 32.4, 34.8, 37, 41.4, 43.8, 45.6, 45.8],
    ],
    'Color' => [
        '150-300 dpi' => [13.5, 17, 20.5, 24, 27.3, 30.6, 33.9, 37.2, 40.5, 43.8, 46.9, 53.1, 53.7, 56.1, 59.3],
        '450-900 dpi' => [14.1, 18.2, 22.3, 26.4, 30.4, 34.2, 38.2, 42, 45.9, 49.9, 53.6, 57.2, 62, 63.9, 68.3],
    ]
];

// Determinar el índice para la cantidad de páginas (1 página = índice 0, 2 páginas = índice 1, etc.)
$indicePaginas = max(0, min($numPaginas - 1, 14)); // El índice no puede ser mayor a 14

// Determinar la clave de resolución en función del valor de `$resolucion`
if ($resolucion >= 150 && $resolucion <= 300) {
    $claveResolucion = '150-300 dpi';
} elseif ($resolucion >= 450 && $resolucion <= 900) {
    $claveResolucion = '450-900 dpi';
} else { 
    die("Resolución fuera de rango (debe estar entre 150-300 dpi o 450-900 dpi).");
}

// Obtener el precio unitario en función de las tarifas y los datos
$precioUnitario = $tarifas[$modoImpresion][$claveResolucion][$indicePaginas];

// Calcular el coste total en función del número de copias
$costeTotal = $precioUnitario * $numCopias;

// Valores estáticos
$costeEnvio = 10; // Coste fijo de procesamiento y envío
$tarifaPagina = $precioUnitario / $numPaginas; // Tarifa aproximada por página
$tarifaFotoColor = $modoImpresion === 'Color' ? 0.5 : 0; // Asumimos un valor simbólico para mostrar en el HTML
$tarifaFotoResolucionAlta = $resolucion > 300 ? 0.2 : 0; // Asumimos un valor simbólico para mostrar en el HTML