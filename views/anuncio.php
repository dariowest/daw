<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalle del Anuncio</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="stylesheet" href="../styles/anuncio.css" />
</head>

<body>
  <?php 
  session_start();
  if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
  }
  include_once "../modules/cabecera.php";

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

  // Obtener el ID del anuncio desde la URL
  $idAnuncio = isset($_GET['id']) ? intval($_GET['id']) : 0;

  // Consulta para obtener los datos del anuncio
  $queryAnuncio = "
      SELECT a.Titulo, a.texto, a.Precio, a.FRegistro AS Publicado, 
             a.Ciudad, p.NomPais AS Pais, 
             tV.NomTVivienda AS TipoVivienda, tA.NomTAnuncio AS TipoAnuncio, 
             a.Foto AS FotoPrincipal
      FROM Anuncios a
      JOIN TiposAnuncios tA ON a.TAnuncio = tA.IdTAnuncio
      JOIN TiposViviendas tV ON a.TVivienda = tV.IdTVivienda
      JOIN Paises p ON a.Pais = p.IdPais
      WHERE a.IdAnuncio = $idAnuncio";

  $resultAnuncio = $mysqli->query($queryAnuncio);

  // Comprobar si existe el anuncio
  if ($resultAnuncio && $resultAnuncio->num_rows > 0) {
      $anuncio = $resultAnuncio->fetch_assoc();
  } else {
      $anuncio = null;
  }

  // Consulta para obtener las fotos adicionales
  $queryFotos = "SELECT Fichero AS Src, titulo FROM Fotos WHERE Anuncio = $idAnuncio";
  $resultFotos = $mysqli->query($queryFotos);
  $fotos = $resultFotos ? $resultFotos->fetch_all(MYSQLI_ASSOC) : [];
  ?>

  <main>
    <?php if ($anuncio): ?>
      <!-- Foto principal -->
      <section>
        <article>
          <figure>
            <img src="../img/<?= htmlspecialchars($anuncio['FotoPrincipal']) ?>" 
                 alt="Foto principal del anuncio" width="500" />
          </figure>
        </article>

        <!-- Título e información del anuncio -->
        <article id="informacion">
          <h1><?= htmlspecialchars($anuncio['Titulo']) ?></h1>
          <h2>Precio: €<?= number_format($anuncio['Precio'], 2) ?></h2>
          <p><?= htmlspecialchars($anuncio['texto']) ?></p>
          <p><strong>Publicado el:</strong> <?= htmlspecialchars($anuncio['Publicado']) ?></p>
          <p><strong>Ciudad:</strong> <?= htmlspecialchars($anuncio['Ciudad']) ?></p>
          <p><strong>País:</strong> <?= htmlspecialchars($anuncio['Pais']) ?></p>
          <p><strong>Tipo de vivienda:</strong> <?= htmlspecialchars($anuncio['TipoVivienda']) ?></p>
          <p><strong>Tipo de anuncio:</strong> <?= htmlspecialchars($anuncio['TipoAnuncio']) ?></p>
        </article>
      </section>

      <h3 id="adicionales">Fotos adicionales</h3>
      <section>
        <?php if (!empty($fotos)): ?>
          <?php foreach ($fotos as $index => $foto): ?>
            <article>
              <figure>
                <img src="../img/<?= htmlspecialchars($foto['Src']) ?>" 
                     alt="Foto adicional <?= $index + 1 ?>" width="500" />
                <figcaption><?= htmlspecialchars($foto['Descripcion']) ?></figcaption>
              </figure>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay fotos adicionales disponibles.</p>
        <?php endif; ?>
      </section>

      <div id="aniadir-foto">
        <button><a href="anuncio_foto.php?id=<?= $idAnuncio ?>">Añadir foto</a></button>
      </div>

      <!-- Enlace para volver -->
      <p><a href="res_busqueda.php">Volver a los resultados de búsqueda</a></p>
    <?php else: ?>
      <p>Lo sentimos, no se ha encontrado el anuncio solicitado.</p>
    <?php endif; ?>
  </main>

  <?php $mysqli->close(); ?>

  <footer>Todos los derechos reservados ©</footer>
</body>
</html>
