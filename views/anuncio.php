<?php
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
}

include_once "../controller/connect.php"; // **Conexión a la base de datos antes de usar $conn**

// Obtener el ID del anuncio desde la URL
$idAnuncio = isset($_GET['id']) ? intval($_GET['id']) : 0;

// **Verificar si el ID del anuncio es válido**
if ($idAnuncio <= 0) {
    echo "Error: ID de anuncio no válido.";
    exit();
}

// **Consulta para obtener el propietario del anuncio**
$sql = "SELECT Usuario FROM anuncios WHERE IdAnuncio = $idAnuncio";
$result = $conn->query($sql);

// **Verificar si se encontró el anuncio**
if ($result && $result->num_rows > 0) {
    $propietario = $result->fetch_assoc();
    $idPropietario = $propietario['Usuario'] ?? 0; // ID del propietario
} else {
    echo "Error: No se encontró el anuncio.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalle del Anuncio</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/anuncio.css" />
  <?php
  include_once("../modules/estilo.php");
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="../js/script.js"></script>
</head>

<body>

  <?php
  include_once "../modules/cabecera.php"; 
  ?>

  <?php
  // **Consulta para obtener los datos del anuncio**
  $queryAnuncio = "
      SELECT a.Titulo, a.texto, a.Precio, a.FRegistro AS Publicado, 
             a.Ciudad, p.NomPais AS Pais, 
             tV.NomTVivienda AS TipoVivienda, tA.NomTAnuncio AS TipoAnuncio, 
             a.Foto AS FotoPrincipal
      FROM anuncios a
      JOIN tiposanuncios tA ON a.TAnuncio = tA.IdTAnuncio
      JOIN tiposviviendas tV ON a.TVivienda = tV.IdTVivienda
      JOIN paises p ON a.Pais = p.IdPais
      WHERE a.IdAnuncio = $idAnuncio";

  $resultAnuncio = $conn->query($queryAnuncio);

  // **Comprobar si existe el anuncio**
  if ($resultAnuncio && $resultAnuncio->num_rows > 0) {
    $anuncio = $resultAnuncio->fetch_assoc();
  } else {
    $anuncio = null;
  }

  // **Consulta para obtener las fotos adicionales**
  $queryFotos = "SELECT Fichero AS Src, titulo FROM fotos WHERE Anuncio = $idAnuncio";
  $resultFotos = $conn->query($queryFotos);
  $fotos = $resultFotos ? $resultFotos->fetch_all(MYSQLI_ASSOC) : [];
  ?>

  <main>
    <?php if ($anuncio): ?>
      <!-- Foto principal -->
      <section>
        <article>
          <figure>
            <img src="../img/anuncios/<?= htmlspecialchars($anuncio['FotoPrincipal']) ?>" 
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
          <?php foreach ($fotos as $foto): ?>
            <article>
              <figure>
                <figcaption>
                  <h3><?= htmlspecialchars($foto['titulo']) ?></h3>
                </figcaption>
                <img src="../img/<?= htmlspecialchars($foto['Src']) ?>" alt="Foto adicional" width="500" />
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

      <div id="enviar-mensaje">
        <button>
          <a href="mensaje.php?anuncio=<?= $idAnuncio ?>&usuario_destino=<?= $idPropietario ?>">Enviar mensaje</a>
        </button>
      </div>

      <!-- Enlace para volver -->
      <p><a href="res_busqueda.php">Volver a los resultados de búsqueda</a></p>
    <?php else: ?>
      <p>Lo sentimos, no se ha encontrado el anuncio solicitado.</p>
    <?php endif; ?>
  </main>

  <?php $conn->close(); ?>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>
