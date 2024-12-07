<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Configuracion</title>
  <script src="../js/script.js"></script>
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
  include_once "../modules/cabecera.php" ?>

  <main>
    <form id="registration-form" action="../controller/res_config.php" method="POST">
      <h3>Configuración</h3>
      <div class="form-alineado">
        <label for="est">Estilo</label>
        <select name="est">
            <option value="5">Estilo normal</option>
            <option value="1">Oscuro</option>
            <option value="2">Letra grande</option>
            <option value="3">Alto contraste</option>
            <option value="4">Letra grande y alto contraste</option>
        </select>
      </div>
      <div class="form-alineado">
        <input type="submit" value="Cambiar" />
      </div>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>