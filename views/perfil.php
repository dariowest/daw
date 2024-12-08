<?php
include '../controller/recordarme.php';

// Verifica si la sesión no está activa antes de iniciarla
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Redirige al login si no hay sesión activa
if (!isset($_SESSION["usu"])) {
  header("Location: login.php");
  exit();
}

include_once "../controller/connect.php";

// Obtener los errores y el éxito de la sesión
$errores = $_SESSION['errores'] ?? [];
$exito = $_GET['success'] ?? null;
unset($_SESSION['errores']); // Limpiar errores para la próxima vez

// Obtener los datos actuales del usuario
$idUsuario = $_SESSION['id_usuario'];
$query = "SELECT NomUsuario, Email FROM usuarios WHERE IdUsuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Perfil</title>
  <link rel="stylesheet" href="../styles/perfil.css" />
  <link rel="stylesheet" href="../styles/global.css" />
  <?php include_once("../modules/estilo.php"); ?>
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>

  <?php include_once "../modules/cabecera.php"; ?>

  <main>
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario['NomUsuario']); ?>!</h1>

    <?php if ($exito): ?>
      <div class="mensaje-exito">
        <p>✅ Los cambios se han guardado correctamente.</p>
      </div>
    <?php endif; ?>

    <section id="modificar_datos">
      
      <!-- Modificar Nombre y Email -->
      <article>
        <h2>Modificar mis datos personales</h2>

        <form action="../controller/actualizar_usuario.php" method="POST">
          <div id="modifica">
            <div class="bloque_modifica">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['NomUsuario']) ?>" />
              <?php if (!empty($errores['nombre'])): ?>
                <p class="error"><?= htmlspecialchars($errores['nombre']) ?></p>
              <?php endif; ?>
            </div>

            <div class="bloque_modifica">
              <label for="email">Email</label>
              <input type="text" name="email" value="<?= htmlspecialchars($usuario['Email']) ?>" />
              <?php if (!empty($errores['email'])): ?>
                <p class="error"><?= htmlspecialchars($errores['email']) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <div class="boton">
            <input type="submit" value="Actualizar datos" />
          </div>
        </form>
      </article>

      <!-- Cambiar Contraseña -->
      <article>
        <h2>Cambiar Contraseña</h2>

        <form action="../controller/actualizar_contrasena.php" method="POST">
          <div id="modifica">
            <div class="bloque_modifica">
              <label for="password_actual">Contraseña Actual</label>
              <input type="password" name="password_actual" />
              <?php if (!empty($errores['password_actual'])): ?>
                <p class="error"><?= htmlspecialchars($errores['password_actual']) ?></p>
              <?php endif; ?>
            </div>

            <div class="bloque_modifica">
              <label for="password_nueva">Nueva Contraseña</label>
              <input type="password" name="password_nueva" />
              <?php if (!empty($errores['password_nueva'])): ?>
                <p class="error"><?= htmlspecialchars($errores['password_nueva']) ?></p>
              <?php endif; ?>
            </div>

            <div class="bloque_modifica">
              <label for="password_confirmar">Confirmar Contraseña</label>
              <input type="password" name="password_confirmar" />
              <?php if (!empty($errores['password_confirmar'])): ?>
                <p class="error"><?= htmlspecialchars($errores['password_confirmar']) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <div class="boton">
            <input type="submit" value="Actualizar Contraseña" />
          </div>
        </form>
      </article>

      <!-- Darse de baja -->
      <article>
        <h2>Darse de baja</h2>
        <p><strong>⚠️ OJO:</strong> Esta acción eliminará permanentemente tu cuenta.</p>
        <div class="boton">
          <a href="confirmar_baja.php">
            <button type="button">Darse de baja</button>
          </a>
        </div>
      </article>

      <!-- Accesos rápidos -->
      <article>
        <h3><a href="crear_anuncio.php">Crear nuevo anuncio</a></h3>
        <h3><a href="mis_anuncios.php">Mis anuncios</a></h3>
        <h3><a href="config.php">Configuración</a></h3>
        <h3><a href="mis_mensajes.php">Mis mensajes</a></h3>
      </article>
    </section>
  </main>

  <footer>Todos los derechos reservados ©</footer>

  <style>
    .error {
      color: red;
      font-size: 0.9rem;
      margin-top: 5px;
    }

    .mensaje-exito {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
    }
  </style>

</body>

</html>
