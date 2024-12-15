<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/global.css" />
  <?php
  include_once("modules/estilo.php");
  ?>
  <link rel="stylesheet" href="styles/imprime-index.css" media="print" />

  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <link rel="stylesheet" href="styles/index.css" />
  <title>Inicio</title>
</head>

<body>
  <?php

  // Leer configuración desde config.ini
  include_once('controller/connect.php');

  $fichero = "recomendacion.txt";
  $contenido = file($fichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $lineaAleatoria = $contenido[array_rand($contenido)];
  list($idAnuncio, $nombreExperto, $comentario) = explode('|', $lineaAleatoria);

  // Consulta para obtener los últimos 5 anuncios
  $query = "
    SELECT 
        a.IdAnuncio, 
        a.Titulo, 
        a.Ciudad, 
        a.Precio, 
        tA.NomTAnuncio AS TipoAnuncio, 
        tV.NomTVivienda AS TipoVivienda, 
        a.Foto, 
        a.FRegistro 
    FROM anuncios a
    JOIN tiposanuncios tA ON a.TAnuncio = tA.IdTAnuncio
    JOIN tiposviviendas tV ON a.TVivienda = tV.IdTVivienda
    ORDER BY a.FRegistro DESC 
    LIMIT 5";



  $result = $conn->query($query);
  // Verificar si hay resultados
  if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
  }

  // Pasar los datos a una variable para incluirlos en muestra_index.php
  $anuncios = $result->fetch_all(MYSQLI_ASSOC);

  include_once "modules/cabecera_index.php";
  ?>

  <main>
    <header>
      <h3>Buscar</h3>
      <form action="views/res_busqueda.php" method="GET">
        <input type="text" name="ciudad" id="buscar" placeholder="Indique una ciudad" />
        <input type="submit" value="Buscar" />
      </form>

      <?php
      // Leer el archivo JSON externo
      $archivo = 'consejo.json';
      $contenido = file_get_contents($archivo);
      $consejos = json_decode($contenido, true);

      // Seleccionar un consejo aleatorio
      $consejoAleatorio = $consejos[array_rand($consejos)];
      ?>
      <div id="consejo">
        <h4>Consejo de Compra/Venta</h4>
        <p class="categoria">Categoría: <?php echo $consejoAleatorio['categoria']; ?></p>
        <p class="importancia">Importancia: <?php echo $consejoAleatorio['importancia']; ?></p>
        <p><?php echo $consejoAleatorio['descripcion']; ?></p>
      </div>

      <h3>Últimas publicaciones</h3>
    </header>
    <?php
    if (isset($_SESSION['usu'])) {
      ?>
      <div style="margin-left: 150px;">
        <h3>Datos del registro:</h3>
        <p><strong>Nombre de usuario:</strong> <?php echo $_SESSION['usu']; ?></p>
      </div>
      <?php
    }
    include_once("modules/muestra_index.php");
    ?>

  </main>
  <div id="recomendacion">
    <h2>Recomendacion de experto</h2>
    <?php
    echo "<p>Recomendacion de: " . $nombreExperto . "</p>";
    echo "<p>Comentario del experto: " . $comentario . "</p>";
    $sql = "
    SELECT 
        a.IdAnuncio, 
        a.Titulo, 
        a.Ciudad, 
        a.Precio, 
        tA.NomTAnuncio AS TipoAnuncio, 
        tV.NomTVivienda AS TipoVivienda, 
        a.Foto, 
        a.FRegistro 
    FROM anuncios a
    JOIN tiposanuncios tA ON a.TAnuncio = tA.IdTAnuncio
    JOIN tiposviviendas tV ON a.TVivienda = tV.IdTVivienda
    WHERE a.IdAnuncio = " . $idAnuncio;
    $result = $conn->query($sql);
    $anuncios = $result->fetch_all(MYSQLI_ASSOC);
    ?>
    <section>
      <?php if (!empty($anuncios)): ?>
        <?php foreach ($anuncios as $anuncio): ?>
          <article>
            <figure>
              <img src="img/<?php echo htmlspecialchars($anuncio['Foto']); ?>"
                alt="Foto del anuncio <?php echo htmlspecialchars($anuncio['Titulo']); ?>" width="200" />
            </figure>
            <aside>
              <h2><a href="views/anuncio.php?id=<?php echo $anuncio['IdAnuncio']; ?>">
                  <?php echo htmlspecialchars($anuncio['Titulo']); ?>
                </a></h2>
              <p><?php echo htmlspecialchars($anuncio['Ciudad']); ?></p>
              <p>€<?php echo number_format($anuncio['Precio'], 2); ?></p>
              <p><?php echo htmlspecialchars($anuncio['TipoVivienda']); ?></p>
              <p><?php echo htmlspecialchars($anuncio['TipoAnuncio']); ?></p>
              <p><?php echo htmlspecialchars($anuncio['FRegistro']); ?></p>
            </aside>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No hay anuncios disponibles.</p>
      <?php endif; ?>
    </section>
    <?php
    ?>

  </div>
  <p id="accesible">
    <a href="views/accesibilidad.php">Accesibilidad</a>
  </p>
  <footer>Todos los derechos reservados ©</footer>
</body>

</html>