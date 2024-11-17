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
  <?php 
  session_start();
  include_once "../modules/cabecera.php" ?>

  <main>
    <h1>Buscar Anuncios</h1>

    <form action="res_busqueda.php" method="POST">
      <!-- Tipo de anuncio (obligatorio) -->
      <div class="tipo-busqueda">
        <label for="tipoAnuncio">Tipo de anuncio:</label>
        <select id="tipoAnuncio" name="tipoAnuncio">
          <option value="">Seleccione una opción</option>
          <option value="venta">Venta</option>
          <option value="alquiler">Alquiler</option>
        </select>
      </div>
      <div class="tipo-busqueda">
        <label for="tipoVivienda">Tipo de vivienda:</label>
        <select id="tipoVivienda" name="tipo-vivienda">
          <option value="">Seleccione una opción</option>
          <option value="Obra nueva">Obra nueva</option>
          <option value="vivienda">Vivienda</option>
          <option value="Oficina">Oficina</option>
          <option value="Local">Local</option>
          <option value="Garaje">Garaje</option>
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
        <label for="precMin">Precio mínimo:</label>
        <input id="precMin" name="precMin" placeholder="€" />
      </div>
      <div class="tipo-busqueda">
        <label for="precMax">Precio máximo:</label>
        <input id="precMax" name="precMax" min="0" placeholder="€" />
      </div>
      <div class="tipo-busqueda">
        <label for="fechaInicio">Fecha desde:</label>
        <input id="fechaInicio" name="fechaInicio" />
      </div>
      <div class="tipo-busqueda">
        <label for="fechaFin">Fecha hasta:</label>
        <input id="fechaFin" name="fechaFin" />
      </div>
      <div class="tipo-busqueda">
        <button type="submit">Buscar</button>
      </div>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>