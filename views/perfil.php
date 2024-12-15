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
$query = "SELECT NomUsuario, Email, Foto FROM usuarios WHERE IdUsuario = ?";
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
  <?php
  include_once("../modules/estilo.php");
  ?>
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php
  // Verificar sesión activa


  // Redirige al login si no hay sesión activa
  if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
  }

  include_once "../modules/cabecera.php";
  ?>

  <!-- Guardar ID del usuario en sessionStorage -->
  <script>
    // Obtener el ID del usuario desde la sesión PHP
    const userId = <?php echo json_encode($_SESSION['id_usuario'] ?? null); ?>;

    // Guardar el ID en sessionStorage si existe
    if (userId) {
      sessionStorage.setItem('userId', userId);
    } else {
      console.error('No se pudo guardar el ID en sessionStorage.');
    }
  </script>

  <main>
    <?php if (isset($_COOKIE['usu'])): ?>
      <h1>Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h1>
      <p>Última visita: <?php echo htmlspecialchars($ultimaVisita); ?></p>
    <?php endif; ?>

    <section id="modificar_datos">
      
      <!-- Modificar Foto de Perfil -->
      <article>
        <h2>Foto de perfil</h2>

        <div class="foto-perfil">
          <!-- Mostrar la foto de perfil o un ícono genérico -->
          <?php if (!empty($usuario['Foto'])): ?>
            <img src="../img/perfiles/<?= htmlspecialchars($usuario['Foto']) ?>" alt="Foto de perfil" width="150" height="150" />
          <?php else: ?>
            <img src="../img/icono-usuario.png" alt="Foto de perfil genérica" width="150" height="150" />
          <?php endif; ?>
        </div>

        <!-- Formulario para subir o eliminar la foto de perfil -->
        <form action="../controller/actualizar_foto.php" method="POST" enctype="multipart/form-data">
          <div class="bloque_modifica">
            <label for="foto">Subir nueva foto de perfil</label>
            <input type="file" name="foto" accept="image/*">
            <?php if (!empty($errores['foto'])): ?>
              <p class="error"><?= htmlspecialchars($errores['foto']) ?></p>
            <?php endif; ?>
          </div>

          <div class="boton">
            <input type="submit" value="Actualizar Foto" />
          </div>
        </form>

        <form action="../controller/eliminar_foto.php" method="POST">
          <div class="boton">
            <input type="submit" value="Eliminar Foto de Perfil" />
          </div>
        </form>
      </article>

      <!-- Modificar Nombre y Email -->
      <article>
        <h2>Modificar mis datos personales</h2>
        <form>
          <div id="modifica">
            <div class="bloque_modifica">
              <label for="nombre">Nombre</label>
              <label for="email">Email</label>
              <label for="password">Contraseña</label>
            </div>
            <div class="bloque_modifica">
              <input type="text" name="nombre" value="Juan Dario Gomez Ardila" />
              <input type="email" name="email" value="jdgomezardila@gmail.com" />
              <input type="password" name="password" value="123456" />
            </div>
          </div>
          <div class="boton">
            <button type="button">Editar datos</button>
          </div>
        </form>
      </article>

      <article>
        <h2>Darse de baja</h2>
        <p>
          <strong>OJO:</strong> Esta acción eliminará permanentemente tu
          cuenta. Recibirás un correo para confirmar la eliminación de tu
          cuenta.
        </p>
        <div class="boton">
          <a href="confirmar_baja.php">
            <button type="button">Darse de baja</button>
          </a>
        </div>
      </article>
      <article>
        <h3><a href="crear_anuncio.php">Crear nuevo anuncio</a></h3>
        <h3><a href="mis_anuncios.php">Mis anuncios</a></h3>
        <h3><a href="config.php">Configuracion</a></h3>
        <h3><a href="mis_mensajes.php">Mis mensajes</a></h3>
      </article>
    </section>

  </main>

  <p><label>o necesitas un anuncio impreso? <a href="form_folleto.php">click aquí</a></label></p>
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

    .foto-perfil img {
      border-radius: 50%;
    }
  </style>

</body>

</html>