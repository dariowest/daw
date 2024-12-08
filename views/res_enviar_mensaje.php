<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirmación de mensaje</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="stylesheet" href="../styles/mensaje.css" />
</head>

<body>

  <?php 
  session_start();
  if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
  }

  include_once "../modules/cabecera.php";

  // Recoger los datos enviados por la URL
  $tipoMensaje = $_GET["tipo-mensaje"] ?? 'No especificado';
  $mensaje = $_GET["mensaje"] ?? 'No se recibió ningún mensaje';
  ?>

  <main>
    <h1>Confirmación de mensaje</h1>
    <h3>Los datos almacenados han sido los siguientes:</h3>

    <form>
      <label> Tipo de mensaje</label>
      <select disabled>
        <option><?= htmlspecialchars($tipoMensaje) ?></option>
      </select>

      <br /><br />

      <label>Mensaje</label>
      <textarea rows="6" cols="50" disabled><?= htmlspecialchars($mensaje) ?></textarea>

      <br /><br />

      <label for="">¡Tu mensaje ha sido enviado con éxito!</label>

      <br /><br />

      <a href="mis_mensajes.php">Ver mis mensajes</a>
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>
</html>
