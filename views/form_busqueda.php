<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar Anuncio</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/form-buscar.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php include_once "../modules/cabecera_log.php" ?>

  <main>
    <h1>Buscar Anuncios</h1>

    <form action="res_busqueda.php" method="get">
      <!-- Tipo de anuncio (obligatorio) -->
      <div class="tipo-busqueda">
        <label for="tipo-anuncio">Tipo de anuncio:</label>
        <select id="tipo-anuncio" name="tipo-anuncio">
          <option value="">Seleccione una opción</option>
          <option value="venta">Venta</option>
          <option value="alquiler">Alquiler</option>
        </select>
      </div>
      <div class="tipo-busqueda">
        <label for="tipo-vivienda">Tipo de vivienda:</label>
        <select id="tipo-vivienda" name="tipo-vivienda">
          <option value="">Seleccione una opción</option>
          <option value="obra-nueva">Obra nueva</option>
          <option value="vivienda">Vivienda</option>
          <option value="oficina">Oficina</option>
          <option value="local">Local</option>
          <option value="garaje">Garaje</option>
        </select>
      </div>
      <div class="tipo-busqueda">
        <label for="ciudad">Ciudad:</label>
        <select id="ciudad" name="ciudad">
          <option value="">Seleccione una opción</option>
          <option value="Alicante">Alicante</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Valencia">Valencia</option>
          <option value="Berlin">Berlin</option>
          <option value="Amsterdam">Amsterdam</option>
        </select>
      </div>
      <div class="tipo-busqueda">
        <label for="pais">País:</label>
        <select id="pais" name="pais">
          <option value="">Seleccione una opción</option>
          <option value="España">España</option>
          <option value="India">India</option>
          <option value="Alemania">Alemania</option>
          <option value="Holanda">Holanda</option>
          <option value="Suiza">Suiza</option>
        </select>
      </div>
      <div class="tipo-busqueda">
        <label for="precio-min">Precio mínimo:</label>
        <input id="precio-min" name="precio-min" placeholder="€" />
      </div>
      <div class="tipo-busqueda">
        <label for="precio-max">Precio máximo:</label>
        <input id="precio-max" name="precio-max" min="0" placeholder="€" />
      </div>
      <div class="tipo-busqueda">
        <label for="fecha-inicio">Fecha desde:</label>
        <input id="fecha-inicio" name="fecha-inicio" />
      </div>
      <div class="tipo-busqueda">
        <label for="fecha-fin">Fecha hasta:</label>
        <input id="fecha-fin" name="fecha-fin" />
      </div>
      <div class="tipo-busqueda">
        <button type="submit">Buscar</button>
      </div>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>