<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>folleto</title>
  <link rel="stylesheet" href="../styles/form_folleto.css" />
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="../js/script.js"></script>
</head>

<body>
  <?php include_once "../modules/cabecera_log.php" ?>

  <main>
    <h1>Solicitud de impresión de folleto publicitario</h1>
    <p>
      Realiza la solicitud de imopresión y envío de tu anuncio con el gusto
      que quieras Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      Perferendis iste vero est nisi. Necessitatibus quia nesciunt minima.
      Aperiam, distinctio a culpa cupiditate aut modi fugit iusto harum,
      soluta inventore tenetur.
    </p>
    <!--Tabla de precios-->
    <section>
      <article>
        <h2>Tarifas</h2>
        <table>
          <thead>
            <tr>
              <th>Concepto</th>
              <th>Tarifa</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Coste procesamiento y envío</td>
              <td>10€</td>
            </tr>
            <tr>
              <td>
                < 5 páginas</td>
              <td>2€ por página</td>
            </tr>
            <tr>
              <td>Entre 5 y 10 páginas</td>
              <td>1.8€ por página</td>
            </tr>
            <tr>
              <td>> 10 páginas</td>
              <td>1.6€ por página</td>
            </tr>
            <tr>
              <td>Blanco y negro</td>
              <td>0€</td>
            </tr>
            <tr>
              <td>Color</td>
              <td>0.5 por foto del anuncio</td>
            </tr>
            <tr>
              <td>Resolución <= 300 dpi</td>
              <td>0€ por foto de anuncio</td>
            </tr>
            <tr>
              <td>Resolución > 300 dpi</td>
              <td>0.2€ por foto de anuncio</td>
            </tr>
          </tbody>
        </table>
      </article>

      <!--Formulario-->
      <article>
        <h2>Formulario de solicitud</h2>
        <p>Rellena el siguiente formulario blablabla</p>
        <p>Los campos marcados con asterisco(*) son obligatorios</p>

        <form method="get" action="folleto.php">
          <p>
            <label>Texto adicional:
              <input id="adicional" name="texto_adicional" size="50" maxlength="100"
                placeholder="ingrese el texto que considere pertinente para el folleto o envío." />
            </label>
          </p>
          <p>
            <label>Nombre:
              <input name="Nombre" id="nombre" maxlength="200" placeholder="Escribe tu nombre" /></label>
          </p>
          <p>
            <label>Email:
              <input id="Email" placeholder="Ingrese su correo electrónico" />
            </label>
          </p>

          <p>
            <label>Dirección:
              <input name="calle" id="calle" placeholder="Calle" />
              <input name="numero" id="numero" placeholder="Número" />
              <input name="cp" id="cp" placeholder="Código postal" />
              <select name="localidad" id="localidad">
                <option value="">Seleccione una localidad</option>
                <option value="Murcia">Murcia</option>
                <option value="Barcelona">Barcelona</option>
                <option value="Barcelona">Alicante</option>
                <option value="Malaga">Málaga</option>
              </select></label>
          </p>
          <p>
            <label for="telefono">Telf:
              <input name="telefono" id="telefono" placeholder="Teléfono" /></label>
          </p>

          <p>
            <label for="color">Color portada: <input name="color" id="color" /></label>
          </p>
          <p>
            <label>Número de copias: <input name="copias" id="copias" /></label>
          </p>
          <p>
            <label for="reso">Resolucion: <input name="reso" id="reso" /><output id="valor">150</output></label>
          </p>

          <p>
            Seleccione el anuncio:
            <select name="anuncio">
              <option value="anuncio1">Anuncio 1</option>
              <option value="anuncio2">Anuncio 2</option>
              <option value="anuncio3">Anuncio 3</option>
            </select>
          </p>
          <p>
            <label>Fecha de recepción: <input id="fecha" /></label>
          </p>

          <p>
            Modo de impresión: <input name="modo_impresion" / id="radio1">Color
            <input name="modo_impresion" / id="radio2">Blanco y negro
          </p>

          <input type="submit" value="¡Solicitar!" />
        </form>
      </article>
    </section>
    <article id="tabla">
      <table>
        <thead>
          <tr>
            <th rowspan="2">Número de páginas</th>
            <th rowspan="2">Número de fotos</th>
            <th colspan="2">Blanco y negro</th>
            <th colspan="2">Color</th>
          </tr>
          <tr>
            <th>150-300 dpi</th>
            <th>450-900 dpi</th>
            <th>150-300 dpi</th>
            <th>450-900 dpi</th>
          </tr>
        </thead>
        <tbody id="interior"></tbody>
      </table>
    </article>

    <div id="mostrar" onclick="muestraTabla();">
      <button>Mostrar/ocultar tabla</button>
    </div>

    <section id="tabla_php">
      <iframe src="../controller/tabla_costes.php" width="100%" height="700px" frameborder="0"></iframe>
    </section>
  </main>

  <footer>Todos los derechos reservados ©</footer>

  <script>
    interiorTabla();
  </script>
</body>

</html>