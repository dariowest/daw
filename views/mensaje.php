<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enviar Mensaje</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/mensaje.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["usu"])) {
    header("Location: login.php");

  }
  include_once "../modules/cabecera.php";
  include_once "../controller/connect.php";
  
  ?>

  <main>
    <form action="res_enviar_mensaje.php" method="POST">
      <h1>Envie un Mensaje al Propietario</h1>
      <!-- Tipo de mensaje -->
      <label for="tipo-mensaje">Tipo de mensaje:</label>
      <br />
      <select id="tipo-mensaje" name="tipo-mensaje" required>
        <option value="">Seleccione el tipo de mensaje</option>
        <?php
        $sql = "SELECT IdTMensaje, NomTMensaje FROM tiposmensajes";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["IdTMensaje"] . '">' . $row["NomTMensaje"] . '</option>';
          }
        } else {
          echo '<option value="" disabled selected>No hay anuncios</option>';
        }

        ?>
      </select>
      <br /><br />

      <!-- Texto del mensaje -->
      <label for="mensaje">Escriba su mensaje:</label>
      <br />
      <textarea id="mensaje" name="mensaje" rows="6" cols="50" placeholder="Escriba aquí su mensaje"
        required></textarea>
      <br /><br />

      <!-- Botón de envío -->
      <!--<button type="submit">Enviar mensaje</button>-->
      <input type="submit" value="Enviar mensaje" />
    </form>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>