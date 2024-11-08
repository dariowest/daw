<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirmación de Solicitud</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/folleto.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="stylesheet" href="../styles/imprime-folleto.css" media="print" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php include_once "../modules/cabecera_unlog.php" ?>

  <main>
    <h1>Resumen de la Solicitud de Impresión</h1>
    <section>
      <article>
        <h2>Detalles del Folleto</h2>
        <p>
          <strong>Texto adicional:</strong> Anuncio destacado para propiedad
          de lujo en el centro de Málaga.
        </p>
        <p><strong>Nombre:</strong> Juan Dario Gomez Ardila</p>
        <p><strong>Email:</strong> juan.dario@mail.com</p>
        <p><strong>Dirección:</strong> Calle Mayor 123, 08001, Barcelona</p>
        <p><strong>Teléfono:</strong> +34 600 123 456</p>
        <p><strong>Color de portada:</strong> #FF5733 (naranja)</p>
        <p><strong>Número de copias:</strong> 50</p>
        <p><strong>Resolución:</strong> 600 dpi</p>
        <p><strong>Fecha de recepción:</strong> 10 de octubre de 2024</p>
        <p><strong>Modo de impresión:</strong> Color</p>
        <p>
          <strong>Anuncio seleccionado:</strong> Anuncio 2 (Anuncio de villa
          en Málaga)
        </p>
      </article>
      <article>
        <h2>Detalles de la Tarifa</h2>
        <p><strong>Coste de procesamiento y envío:</strong> 10€</p>
        <p>
          <strong>Número de páginas:</strong> 8 páginas (Tarifa: 1.8€ por
          página)
        </p>
        <p><strong>Blanco y negro:</strong> No</p>
        <p><strong>Color:</strong> Sí (0.5€ por foto)</p>
        <p><strong>Resolución:</strong> > 300 dpi (0.2€ por foto)</p>
        <p><strong>Total estimado:</strong> 50.8€</p>
      </article>
    </section>
  </main>

  <footer>Todos los derechos reservados © 2024 Idealista</footer>
</body>

</html>