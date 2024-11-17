<?php
// Verificar si hay errores o datos pasados desde el redireccionamiento
$errores = isset($_GET['errores']) ? json_decode($_GET['errores'], true) : [];
$datos = isset($_GET['data']) ? json_decode($_GET['data'], true) : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <script src="../js/script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/error.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="stylesheet" href="../styles/form-buscar.css" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php 
  session_start();
  include_once "../modules/cabecera.php" ?>
  <main>
    <form id="registration-form" action="../controller/registro_respuesta.php" method="POST">
      <h3>Registrar Usuario</h3>

      <!-- Nombre de usuario -->
      <div class="form-alineado">
        <label for="usu">Nombre de usuario:</label>
        <input id="usu" name="usu" value="<?= htmlspecialchars($datos['usu'] ?? '') ?>" />
        <?php if (isset($errores['usu'])): ?>
          <div style="color: red;"><?= $errores['usu'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Correo electrónico -->
      <div class="form-alineado">
        <label for="email">Correo electrónico:</label>
        <input id="email" name="email" value="<?= htmlspecialchars($datos['email'] ?? '') ?>" />
        <?php if (isset($errores['email'])): ?>
          <div style="color: red;"><?= $errores['email'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Contraseña -->
      <div class="form-alineado">
        <label for="pwd">Contraseña:</label>
        <input id="pwd" name="pwd" type="password" />
        <?php if (isset($errores['pwd'])): ?>
          <div style="color: red;"><?= $errores['pwd'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Confirmar Contraseña -->
      <div class="form-alineado">
        <label for="pwd2">Confirmar contraseña:</label>
        <input id="pwd2" name="pwd2" type="password" />
        <?php if (isset($errores['pwd2'])): ?>
          <div style="color: red;"><?= $errores['pwd2'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Sexo -->
      <div class="form-alineado">
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
          <option value="masculino" <?= isset($datos['sexo']) && $datos['sexo'] === 'masculino' ? 'selected' : '' ?>>Masculino</option>
          <option value="femenino" <?= isset($datos['sexo']) && $datos['sexo'] === 'femenino' ? 'selected' : '' ?>>Femenino</option>
          <option value="otro" <?= isset($datos['sexo']) && $datos['sexo'] === 'otro' ? 'selected' : '' ?>>Otro</option>
        </select>
      </div>

      <!-- Fecha de nacimiento -->
      <div class="form-alineado">
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($datos['fecha_nacimiento'] ?? '') ?>" />
      </div>

      <!-- Ciudad -->
      <div class="form-alineado">
        <label for="ciudad">Ciudad de residencia:</label>
        <input id="ciudad" name="ciudad" value="<?= htmlspecialchars($datos['ciudad'] ?? '') ?>" />
      </div>

      <!-- País -->
      <div class="form-alineado">
        <label for="pais">País de residencia:</label>
        <input id="pais" name="pais" value="<?= htmlspecialchars($datos['pais'] ?? '') ?>" />
      </div>

      <div class="form-alineado">
        <input type="submit" value="Registrar" />
      </div>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>
