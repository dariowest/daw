<?php
session_start();

// Obtener errores y datos de la sesión
$errores = $_SESSION['errores'] ?? [];
$datos = $_SESSION['datos'] ?? [];

// Limpiar la sesión para evitar conflictos futuros
unset($_SESSION['errores'], $_SESSION['datos']);
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
  include_once '../controller/connect.php';
  include_once "../modules/cabecera.php";
  ?>
  <main>
    <form id="registration-form" action="../controller/registro_respuesta.php" method="POST" enctype="multipart/form-data">
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
          <option value="">Seleccione</option>
          <option value="1" <?= isset($datos['sexo']) && $datos['sexo'] === '1' ? 'selected' : '' ?>>Masculino</option>
          <option value="2" <?= isset($datos['sexo']) && $datos['sexo'] === '2' ? 'selected' : '' ?>>Femenino</option>
        </select>
        <?php if (isset($errores['sexo'])): ?>
          <div style="color: red;"><?= $errores['sexo'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Fecha de nacimiento -->
      <div class="form-alineado">
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($datos['fecha_nacimiento'] ?? '') ?>" />
        <?php if (isset($errores['fecha_nacimiento'])): ?>
          <div style="color: red;"><?= $errores['fecha_nacimiento'] ?></div>
        <?php endif; ?>
      </div>

      <!-- País -->
      <div class="form-alineado">
        <label for="pais">País de residencia:</label>
        <select id="pais" name="pais">
          <option value="">Seleccione</option>
          <?php
          $sql = "SELECT IdPais, NomPais FROM paises";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $selected = isset($datos['pais']) && $datos['pais'] == $row["IdPais"] ? 'selected' : '';
              echo '<option value="' . $row["IdPais"] . '" ' . $selected . '>' . $row["NomPais"] . '</option>';
            }
          }
          ?>
        </select>
        <?php if (isset($errores['pais'])): ?>
          <div style="color: red;"><?= $errores['pais'] ?></div>
        <?php endif; ?>
      </div>


      <!-- Ciudad -->
      <div class="form-alineado">
        <label for="ciudad">Ciudad:</label>
        <input id="ciudad" name="ciudad" value="<?= htmlspecialchars($datos['ciudad'] ?? '') ?>" placeholder="Ingrese su ciudad" />
        <?php if (isset($errores['ciudad'])): ?>
          <div style="color: red;"><?= $errores['ciudad'] ?></div>
        <?php endif; ?>
      </div>

      <!-- Foto -->
      <div class="form-alineado">
        <label for="foto">Foto de perfil:</label>
        <input type="file" id="foto" name="foto" accept="image/*">
        <?php if (isset($errores['foto'])): ?>
          <div style="color: red;"><?= $errores['foto'] ?></div>
        <?php endif; ?>
      </div>

      <div class="form-alineado">
        <input type="submit" value="Registrar" />
      </div>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>