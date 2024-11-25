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
  include_once ("../modules/estilo.php");
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
        <form>
          <h2>Modificar mis datos personales</h2>
          <label for="nombre">Nombre: </label>
          <input type="text" id="nombre" value="Juan Dario Gomez Ardila" />
          <br /><br />
          <label for="email">Email: </label>
          <input type="email" id="email" value="jdgomezardila@gmail.com" />
          <br /><br />
          <label for="password">Contraseña: </label>
          <input type="password" id="password" value="123456" />
          <br /><br />
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
          <button type="button">Darse de baja</button>
        </div>
      </article>
    </section>

    <!-- Mis anuncios -->

    <div id="nuevo">
      <div class="boton">
        <button><a href="crear_anuncio.php">Crear nuevo anuncio</a></button>
        <button><a href="mis_anuncios.php">Mis anuncios</a></button>
      </div>
      <p>
        <label>o necesitas un anuncio impreso?:<a href="form_folleto.php">click aquí</a></label>
      </p>
    </div>

    <!-- Mensajes enviados -->
    <h2><a href="mis_mensajes.php">Mis mensajes</a></h2>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>
