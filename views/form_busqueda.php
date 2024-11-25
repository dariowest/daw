<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar Anuncio</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/form-buscar.css" />
  <?php
  include_once ("../modules/estilo.php");
  ?>
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php

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

  // Consultas para cargar las opciones
  $tiposAnuncios = $mysqli->query("SELECT IdTAnuncio, NomTAnuncio FROM tiposanuncios ORDER BY NomTAnuncio");
  $tiposViviendas = $mysqli->query("SELECT IdTVivienda, NomTVivienda FROM tiposviviendas ORDER BY NomTVivienda");
  $paises = $mysqli->query("SELECT IdPais, NomPais FROM paises ORDER BY NomPais");
  ?>

  <main>
    <h1>Buscar Anuncios</h1>

    <form action="res_busqueda.php" method="POST">
      <!-- Tipo de anuncio (obligatorio) -->
      <div class="tipo-busqueda">
        <label for="tipoAnuncio">Tipo de anuncio:</label>
        <select id="tipoAnuncio" name="tipoAnuncio">
          <option value="">Seleccione una opción</option>
          <?php while ($fila = $tiposAnuncios->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($fila['IdTAnuncio']) ?>">
              <?= htmlspecialchars($fila['NomTAnuncio']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Tipo de vivienda -->
      <div class="tipo-busqueda">
        <label for="tipoVivienda">Tipo de vivienda:</label>
        <select id="tipoVivienda" name="tipoVivienda">
          <option value="">Seleccione una opción</option>
          <?php while ($fila = $tiposViviendas->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($fila['IdTVivienda']) ?>">
              <?= htmlspecialchars($fila['NomTVivienda']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- País -->
      <div class="tipo-busqueda">
        <label for="pais">País:</label>
        <select id="pais" name="pais">
          <option value="">Seleccione una opción</option>
          <?php while ($fila = $paises->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($fila['IdPais']) ?>">
              <?= htmlspecialchars($fila['NomPais']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Otros campos -->
      <div class="tipo-busqueda">
        <label for="ciudad">Ciudad:</label>
        <input id="ciudad" name="ciudad" placeholder="Ciudad" />
      </div>
      <div class="tipo-busqueda">
        <label for="precMin">Precio mínimo:</label>
        <input id="precMin" name="precMin" type="number" min="0" placeholder="€">
      </div>
      <div class="tipo-busqueda">
        <label for="precMax">Precio máximo:</label>
        <input id="precMax" name="precMax" type="number" min="0" placeholder="€">
      </div>

      <div class="tipo-busqueda">
        <label for="fechaInicio">Fecha desde:</label>
        <input id="fechaInicio" name="fechaInicio" type="date" />
      </div>
      <div class="tipo-busqueda">
        <label for="fechaFin">Fecha hasta:</label>
        <input id="fechaFin" name="fechaFin" type="date" />
      </div>
      <div class="tipo-busqueda">
        <button type="submit">Buscar</button>
      </div>
    </form>
  </main>

  <?php
  // Cerrar conexión a la base de datos
  $mysqli->close();
  ?>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>