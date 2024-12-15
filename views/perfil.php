<?php
include '../controller/recordarme.php';
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
</body>

</html>