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
  <?php include_once "../modules/cabecera_log.php" ?>

  <?php
  // Incluir el archivo con los datos de los anuncios
  include "../controller/datos_anuncio.php";

  // Obtener el ID del anuncio desde la URL
  $idAnuncio = $_GET['id'] ?? null;
  $anuncio = $anuncios[$idAnuncio] ?? null;
  ?>

  <main>
    <?php if ($anuncio): ?>
      <!-- Foto principal -->
      <section>
        <article>
          <figure>
            <img src="<?= $anuncio['foto_principal']['src'] ?>" alt="Foto principal del anuncio" width="500" />
            <figcaption><?= $anuncio['foto_principal']['descripcion'] ?></figcaption>
          </figure>
        </article>

        <!-- Título del anuncio -->
        <article id="informacion">
          <h1><?= $anuncio['titulo'] ?></h1>
          <h2>Precio: <?= $anuncio['precio'] ?></h2>
          <p><?= $anuncio['descripcion'] ?></p>
          <p><strong>Publicado el:</strong> <?= $anuncio['publicado'] ?></p>
          <p><strong>Ciudad:</strong> <?= $anuncio['ubicacion'] ?></p>
          <p><strong>País:</strong> <?= $anuncio['pais'] ?></p>
          <h3>Características</h3>
          <ul>
            <?php foreach ($anuncio['caracteristicas'] as $caracteristica): ?>
              <li><?= $caracteristica ?></li>
            <?php endforeach; ?>
          </ul>
        </article>
      </section>

      <h3 id="adicionales">Fotos adicionales</h3>
      <section>
        <?php foreach ($anuncio['fotos'] as $index => $foto): ?>
          <article>
            <figure>
              <img src="<?= $foto['src'] ?>" alt="Foto <?= $index + 1 ?>" width="500" />
              <figcaption><?= $foto['descripcion'] ?></figcaption>
            </figure>
          </article>
        <?php endforeach; ?>
      </section>

      <div id="aniadir-foto">
        <button><a href="anuncio_foto.php?id=<?= $idAnuncio ?>">Añadir foto</a></button>
      </div>

      <!-- Usuario que publicó el anuncio -->
      <p><strong>Publicado por:</strong> Juan Pérez</p>

      <!-- Mensaje de contacto -->
      <h3><a href="mensaje.php">¿Quieres contactar? haz clic aquí</a></h3>

      <!-- Enlace para volver a la página de búsqueda -->
      <p><a href="res_busqueda.php">Volver a los resultados de búsqueda</a></p>
    <?php else: ?>
      <p>Lo sentimos, no se ha encontrado el anuncio solicitado.</p>
    <?php endif; ?>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>
</html>
