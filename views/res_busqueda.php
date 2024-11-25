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
  <?php 
  session_start();
  include_once '../modules/cabecera.php';

  // Leer configuración desde config.ini
  $config = parse_ini_file('../config.ini', true);

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

  // Capturar parámetros del formulario
  $tipoAnuncio = isset($_POST['tipoAnuncio']) ? trim($_POST['tipoAnuncio']) : '';
  $tipoVivienda = isset($_POST['tipoVivienda']) ? trim($_POST['tipoVivienda']) : '';
  $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
  $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';
  $precMin = isset($_POST['precMin']) ? (float) trim($_POST['precMin']) : null;
  $precMax = isset($_POST['precMax']) ? (float) trim($_POST['precMax']) : null;
  $fechaInicio = isset($_POST['fechaInicio']) ? trim($_POST['fechaInicio']) : '';
  $fechaFin = isset($_POST['fechaFin']) ? trim($_POST['fechaFin']) : '';

  // Construir la consulta dinámica
  $query = "SELECT a.IdAnuncio, a.Titulo, a.Ciudad, a.Precio, tA.NomTAnuncio AS TipoAnuncio, 
                   tV.NomTVivienda AS TipoVivienda, a.Foto, a.FRegistro 
            FROM anuncios a
            JOIN tiposanuncios tA ON a.TAnuncio = tA.IdTAnuncio
            JOIN tiposviviendas tV ON a.TVivienda = tV.IdTVivienda
            JOIN paises p ON a.Pais = p.IdPais
            WHERE 1=1";

  // Agregar condiciones dinámicas según los parámetros enviados
  if ($tipoAnuncio) {
      $query .= " AND tA.IdTAnuncio = " . intval($tipoAnuncio);
  }
  if ($tipoVivienda) {
      $query .= " AND tV.IdTVivienda = " . intval($tipoVivienda);
  }
  if ($ciudad) {
      $query .= " AND a.Ciudad LIKE '%" . $mysqli->real_escape_string($ciudad) . "%'";
  }
  if ($pais) {
      $query .= " AND p.IdPais = " . intval($pais);
  }
  if ($precMin !== null) {
      $query .= " AND a.Precio >= " . $precMin;
  }
  if ($precMax !== null) {
      $query .= " AND a.Precio <= " . $precMax;
  }
  if ($fechaInicio) {
      $query .= " AND a.FRegistro >= '" . $mysqli->real_escape_string($fechaInicio) . "'";
  }
  if ($fechaFin) {
      $query .= " AND a.FRegistro <= '" . $mysqli->real_escape_string($fechaFin) . "'";
  }

  $query .= " ORDER BY a.FRegistro DESC";

  // Ejecutar la consulta
  $result = $mysqli->query($query);

  if (!$result) {
      die("Error en la consulta: " . $mysqli->error);
  }

  // Almacenar resultados en un array
  $anuncios = $result->fetch_all(MYSQLI_ASSOC);
  ?>

  <main>
    <h1>Resultados de búsqueda</h1>
    <article id="datos">
      <h2>Parámetros de la búsqueda</h2>
      <p><strong>Tipo de anuncio:</strong> <?= htmlspecialchars($tipoAnuncio) ?></p>
      <p><strong>Tipo de vivienda:</strong> <?= htmlspecialchars($tipoVivienda) ?></p>
      <p><strong>Ciudad:</strong> <?= htmlspecialchars($ciudad) ?></p>
      <p><strong>País:</strong> <?= htmlspecialchars($pais) ?></p>
      <p><strong>Precio mínimo:</strong> <?= htmlspecialchars($precMin) ?></p>
      <p><strong>Precio máximo:</strong> <?= htmlspecialchars($precMax) ?></p>
      <p><strong>Fecha desde:</strong> <?= htmlspecialchars($fechaInicio) ?></p>
      <p><strong>Fecha hasta:</strong> <?= htmlspecialchars($fechaFin) ?></p>
    </article>

    <section>
      <?php if (!empty($anuncios)) : ?>
        <?php foreach ($anuncios as $anuncio) : ?>
          <article>
            <figure>
              <img src="../img/<?= htmlspecialchars($anuncio['Foto']) ?>" 
                   alt="Foto del anuncio <?= htmlspecialchars($anuncio['Titulo']) ?>" width="200" />
            </figure>
            <aside>
              <h2><a href="anuncio.php?id=<?= $anuncio['IdAnuncio'] ?>">
                  <?= htmlspecialchars($anuncio['Titulo']) ?>
              </a></h2>
              <p><?= htmlspecialchars($anuncio['Ciudad']) ?></p>
              <p>€<?= number_format($anuncio['Precio'], 2) ?></p>
              <p><?= htmlspecialchars($anuncio['TipoVivienda']) ?></p>
              <p><?= htmlspecialchars($anuncio['TipoAnuncio']) ?></p>
              <p><?= htmlspecialchars($anuncio['FRegistro']) ?></p>
            </aside>
          </article>
        <?php endforeach; ?>
      <?php else : ?>
        <p>No se encontraron resultados.</p>
      <?php endif; ?>
    </section>
  </main>

  <?php $mysqli->close(); ?>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>
