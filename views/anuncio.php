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
    <link rel="stylesheet" href="../styles/anuncio.css" />
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
    <link rel="stylesheet" href="../styles/imprime-anuncio.css" media="print" />
    <link
      rel="alternative stylesheet"
      href="../styles/contraste-letra.css"
      title="Estilo letra mayor y alto contraste"
    />
  </head>
  <body>
    <?php include_once "../modules/cabecera_log.php"?>

    <main>
      <!-- Foto principal -->
      <section>
        <article>
          <figure>
            <img
              src="../img/foto-principal.jpg"
              alt="Foto principal del anuncio"
              width="500"
            />
            <figcaption>Foto principal del anuncio</figcaption>
          </figure>
        </article>

        <!-- Título del anuncio -->
        <article id="informacion">
          <h1>Título del anuncio</h1>
          <h2>Precio: €1,200/mes</h2>
          <p>
            Este es el texto del anuncio. Aquí se describe la propiedad, las
            características principales, el estado del inmueble, etc.
          </p>
          <p><strong>Publicado el:</strong> 28 de septiembre de 2024</p>
          <p><strong>Ciudad:</strong> Madrid</p>
          <p><strong>País:</strong> España</p>
          <h3>Características</h3>
          <ul>
            <li>3 habitaciones</li>
            <li>2 baños</li>
            <li>120 m²</li>
            <li>Aire acondicionado</li>
            <li>Terraza</li>
          </ul>
        </article>
      </section>
      <h3 id="adicionales">Fotos adicionales</h3>
      <section>
        <article>
          <figure>
            <img src="../img/foto1.jpg" alt="Foto 1" width="500" />
            <figcaption>Foto de la sala</figcaption>
          </figure>
        </article>

        <article>
          <figure>
            <img src="../img/foto2.jpg" alt="Foto 2" width="500" />
            <figcaption>Foto de la cocina</figcaption>
          </figure>
        </article>

        <article>
          <figure>
            <img src="../img/foto3.jpg" alt="Foto 3" width="500" />
            <figcaption>Foto del dormitorio principal</figcaption>
          </figure>
        </article>
      </section>

      <!-- Usuario que publicó el anuncio -->

      <p><strong>Publicado por:</strong> Juan Pérez</p>

      <!-- Mensaje de contacto -->

      <h3><a href="mensaje.php">Quieres contactar? click aquí</a></h3>

      <!-- Enlace para volver a la página de búsqueda -->

      <p><a href="res_busqueda.php">Volver a los resultados de búsqueda</a></p>
    </main>

    <footer>Todos los derechos reservados ©</footer>
  </body>
</html>
