<?php
session_start();
include_once '../controller/connect.php';

// Verificar sesión activa
if (!isset($_SESSION['usu'])) {
  header("Location: login.php");
  exit();
}

// Verificar si tenemos el ID de la última solicitud desde la sesión
$solicitud_id = $_SESSION['ultima_solicitud_id'] ?? 0;

if ($solicitud_id > 0) {
  // Obtener los últimos detalles de la solicitud de este usuario
  $query = "SELECT * FROM solicitudes WHERE IdSolicitud = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $solicitud_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $solicitud = $result->fetch_assoc();
} else {
  $solicitud = null;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirmación de Solicitud</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/folleto.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="stylesheet" href="../styles/imprime-folleto.css" media="print" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php
  include_once "../modules/cabecera.php";
  ?>

  <main>
    <h1>Resumen de la Solicitud de Impresión</h1>

    <?php if ($solicitud): ?>
      <section>
        <article>
          <h2>Detalles del Folleto</h2>
          <p><strong>Texto adicional:</strong> <?= htmlspecialchars($solicitud['Texto']) ?></p>
          <p><strong>Nombre:</strong> <?= htmlspecialchars($solicitud['Nombre']) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($solicitud['Email']) ?></p>
          <p><strong>Dirección:</strong> <?= htmlspecialchars($solicitud['Direccion']) ?></p>
          <p><strong>Teléfono:</strong> <?= htmlspecialchars($solicitud['Telefono']) ?></p>
          <p><strong>Color de portada:</strong> <?= htmlspecialchars($solicitud['Color']) ?></p>
          <p><strong>Número de copias:</strong> <?= htmlspecialchars($solicitud['Copias']) ?></p>
          <p><strong>Resolución:</strong> <?= htmlspecialchars($solicitud['Resolucion']) ?> dpi</p>
          <p><strong>Modo de impresión:</strong> <?= $solicitud['IColor'] ? 'Color' : 'Blanco y negro' ?></p>
          <p><strong>Fecha de recepción:</strong> <?= htmlspecialchars($solicitud['Fecha']) ?></p>
          <p><strong>Anuncio:</strong> <?= htmlspecialchars($solicitud['Anuncio']) ?></p>
        </article>

        <article>
          <h2>Detalles de la Tarifa</h2>
          <p><strong>Coste de procesamiento y envío:</strong> 10 €</p>
          <p><strong>Tarifa por página:</strong> <?= htmlspecialchars($solicitud['IPrecio']) ?> € por página</p>
          <p><strong>Color:</strong> <?= $solicitud['IColor'] ? 'Sí' : 'No' ?></p>
          <p><strong>Resolución:</strong> <?= ($solicitud['Resolucion'] ?? 0) > 300 ? '> 300 dpi' : '300 dpi o menos' ?></p>
          <p><strong>Total estimado por copia:</strong> <?= $solicitud['Copias'] > 0 ? number_format(($solicitud['Coste'] ?? 0) / $solicitud['Copias'], 2) : 'No disponible' ?> €</p>
          <p><strong>Coste final para <?= htmlspecialchars($solicitud['Copias'] ?? '0') ?> copias:</strong> <?= number_format($solicitud['Coste'] ?? 0, 2) ?> €</p>
        </article>
      </section>
    <?php else: ?>
      <p><strong>No se encontró la solicitud de impresión.</strong></p>
    <?php endif; ?>
  </main>

  <footer>Todos los derechos reservados © 2024 Idealista</footer>
</body>

</html>