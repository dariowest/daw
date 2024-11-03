<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalle del Anuncio</title>
    <link rel="stylesheet" href="../styles/global.css" />
    <link
      rel="stylesheet"
      href="../styles/estilo-estandar.css"
      title="Estilo principal"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/oscuro.css"
      title="Modo oscuro"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/contraste.css"
      title="Estilo alto contraste"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/letra-mayor.css"
      title="Estilo letra mayor"
    />
    <link rel="stylesheet" href="../styles/mensaje.css" />
    <link
      rel="alternative stylesheet"
      href="../styles/contraste-letra.css"
      title="Estilo letra mayor y alto contraste"
    />
    <!-- Enlace a Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <body>

    <?php include_once "../modules/cabecera_log.php"?>
    <main>
      <!--Texto: MENSAJE ENVIADO-->
      <h1>Confirmación de mensaje</h1>
      <h3>Los datos almacenados han sido los siguientes:</h3>
      <form>
        <label> Tipo de mensaje</label>
        <br />
        <select disabled>
          <option>Consulta</option>
        </select>
        <br />
        <br />
        <label>Mensaje</label>
        <br />
        <textarea rows="6" cols="50" disabled>
Este es un mensaje de prueba</textarea
        >
        <br />
        <label for="">Tu mensaje ha sido enviado con éxito!</label>
        <br />
        <!--<button>Ok</button>-->
        <a href="anuncio.php">Ok</a>
      </form>
      <!--Tipo de mensaje-->
      <!--texto-->
    </main>
    <footer>Todos los derechos reservados ©</footer>
  </body>
</html>
