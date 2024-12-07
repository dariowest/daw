<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalle del Anuncio</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/anuncio.css" />
  <?php
  include_once ("../modules/estilo.php");
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="../js/script.js"></script>
</head>

<body>
  
  <?php 
  if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
  }
  include_once "../modules/cabecera.php";

  // Leer configuración desde config.ini
include_once ("../controller/connect.php");

$sql = "SELECT Usuario FROM anuncios WHERE IdAnuncio = ".$_GET['id'];

$result = $conn->query($sql);
if ($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) {
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); // Sanitizar el valor del parámetro GET
echo "<a href='../controller/eliminaNuncio.php?id=$id' onclick=\"compruebaOperacion(event, 'eliminaNuncio.php?id=$id')\">
        <span style='color: red;'>Eliminar anuncio</span>
      </a>";
    }
  }



  // Obtener el ID del anuncio desde la URL
  $idAnuncio = isset($_GET['id']) ? intval($_GET['id']) : 0;

  // Consulta para obtener los datos del anuncio
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

  // Comprobar si existe el anuncio
  if ($resultAnuncio && $resultAnuncio->num_rows > 0) {
      $anuncio = $resultAnuncio->fetch_assoc();
  } else {
      $anuncio = null;
  }

  // Consulta para obtener las fotos adicionales
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
      <?php
      $sql="SELECT IdFoto, Titulo, Fichero, Alternativo, Anuncio FROM fotos WHERE Anuncio=".$_GET['id'];
      ?>
      <section>
      <?php
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
      ?>
            <article>
              <figure>
                <figcaption>
                  <h3><?php echo $row["Titulo"]?></h3>
                </figcaption>
                <img src="../img/<?php echo $row["Fichero"]?>" alt="<?php echo $row["Alternativo"]?>" width="500"/>
              </figure>
            </article>
            <?php
        }
      }
      else{
        ?>
        <p>No hay fotos adicionales disponibles.</p>
          <?php
          }
          ?>
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

  <?php $conn->close(); ?>

  <footer>Todos los derechos reservados ©</footer>
</body>
</html>
