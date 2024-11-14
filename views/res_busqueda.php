<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resultados de Búsqueda</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="stylesheet" href="../styles/index.css" />
  <link rel="stylesheet" href="../styles/imprime-index.css" media="print" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php include_once '../modules/cabecera_log.php' ?>
  <main>
    <h1>Resultados de búsqueda</h1>
    <article>
      <?php include '../controller/respuesta_buscar.php'; ?>
      <h1>Resultados de la Búsqueda</h1>
      <h2>Parametros de la búsqueda</h2>
      <p><strong>Tipo de anuncio:</strong> <?= $tipoAnuncio ?></p>
      <p><strong>Tipo de vivienda:</strong> <?= $tipoVivienda ?></p>
      <p><strong>Ciudad:</strong> <?= $ciudad ?></p>
      <p><strong>Pais:</strong> <?= $pais ?></p>
      <p><strong>Precio minimo:</strong> <?= $precMin ?></p>
      <p><strong>Precio máximo:</strong> <?= $precMax ?></p>
      <p><strong>fechaInicio:</strong> <?= $fechaInicio ?></p>
      <p><strong>fechaFin:</strong> <?= $fechaFin ?></p>
    </article>
    <?php
    //acá capturo el valor de la ciudad ingresada por el usuario
    $ciudad = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';

    include_once '../modules/muestra_anuncios.php'; ?>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>