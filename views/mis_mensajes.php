<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mis Mensajes</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/mis_mensajes.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["usu"])){
    header("Location: login.php");

}
  include_once "../modules/cabecera.php" ?>

  <main>
    <h1>Mis mensajes</h1>

    <!-- Mensajes enviados -->
    <section>
      <h2>Mensajes Enviados</h2>
      <table>
        <thead>
          <tr>
            <th>Tipo de Mensaje</th>
            <th>Texto</th>
            <th>Fecha</th>
            <th>Receptor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Consulta</td>
            <td>
              Estoy interesado en el inmueble, ¿podríamos agendar una visita?
            </td>
            <td>25 de septiembre de 2024</td>
            <td>Pedro Martínez</td>
          </tr>
          <tr>
            <td>Oferta</td>
            <td>Me gustaría hacer una oferta por el inmueble.</td>
            <td>20 de septiembre de 2024</td>
            <td>María López</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Mensajes recibidos -->
    <section>
      <h2>Mensajes Recibidos</h2>
      <table>
        <thead>
          <tr>
            <th>Tipo de Mensaje</th>
            <th>Texto</th>
            <th>Fecha</th>
            <th>Emisor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Respuesta</td>
            <td>
              Gracias por tu interés, podemos agendar la visita el lunes.
            </td>
            <td>26 de septiembre de 2024</td>
            <td>Pedro Martínez</td>
          </tr>
          <tr>
            <td>Aclaración</td>
            <td>El precio es negociable dependiendo de las condiciones.</td>
            <td>21 de septiembre de 2024</td>
            <td>María López</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>