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
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php 
  session_start();
  if (!isset($_SESSION["usu"])){
    header("Location: login.php");

}
  include_once "../modules/cabecera.php" ?>

  <main>
    <h1>Resumen de la Solicitud de Impresión</h1>

    <?php include '../controller/respuesta_folleto.php'; ?>

    <section>
      <article>
        <h2>Detalles del Folleto</h2>
        <p><strong>Texto adicional:</strong> <?= $textoAdicional ?></p>
        <p><strong>Nombre:</strong> <?= $nombre ?></p>
        <p><strong>Email:</strong> <?= $email ?></p>
        <p><strong>Dirección:</strong> <?= $direccion ?></p>
        <p><strong>Teléfono:</strong> <?= $telefono ?></p>
        <p><strong>Color de portada:</strong> <?= $colorPortada ?></p>
        <p><strong>Número de copias:</strong> <?= $numCopias ?></p>
        <p><strong>Resolución:</strong> <?= $resolucion ?> dpi</p>
        <p><strong>Modo de impresión:</strong> <?= $modoImpresion ?></p>
        <p><strong>Anuncio: </strong> <?= $anuncio ?></p>
      </article>

      <article>
        <h2>Detalles de la Tarifa</h2>
        <p><strong>Coste de procesamiento y envío:</strong> <?= $costeEnvio ?> €</p>
        <p><strong>Número de páginas:</strong> <?= $numPaginas ?> páginas (Tarifa: <?= $tarifaPagina ?> € por página)</p>
        <p><strong>Color:</strong> <?= ($modoImpresion === 'Color' ? 'Sí' : 'No') ?> (<?= $tarifaFotoColor ?> € por foto)</p>
        <p><strong>Resolución:</strong> <?= ($resolucion > 300 ? '> 300 dpi' : '300 dpi o menos') ?> (<?= $tarifaFotoResolucionAlta ?> € por foto)</p>
        <p><strong>Total estimado por copia:</strong> <?= number_format($precioUnitario, 2) ?> €</p>
        <p><strong>Coste final para <?= $numCopias ?> copias:</strong> <?= number_format($costeTotal, 2) ?> €</p>
      </article>
    </section>
  </main>

  <footer>Todos los derechos reservados © 2024 Idealista</footer>
</body>

</html>