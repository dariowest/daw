<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/global.css" />
  <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
  <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <link rel="stylesheet" href="styles/imprime-index.css" media="print" />

  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <link rel="stylesheet" href="styles/index.css" />
  <title>Inicio</title>
</head>

<body>
  <?php include_once "modules/cabecera_index.php"; ?>

  <main>

    <header>
      <h3>Buscar</h3>
      <form action="/views/res_busqueda.html">
        <input type="text" name="" id="buscar" />
        <input type="submit" value="Buscar" />
      </form>
      <h3>Últimas publicaciones</h3>
    </header>
    <section>
      <article>
        <figure>
          <img src="img/foto1.jpg" alt="Foto del anuncio 1" width="200" />
        </figure>
        <aside>
          <h2><a href="views/login.html">Título</a></h2>
          <p>Madrid</p>
          <p>€1,200/mes</p>
          <p>Piso</p>
          <p>Alquiler</p>
          <p>20/9/2024</p>
        </aside>
      </article>
      <article>
        <figure>
          <img src="img/foto1.jpg" alt="Foto del anuncio 1" width="200" />
        </figure>
        <aside>
          <h2><a href="views/login.html">Título</a></h2>
          <p>Madrid</p>
          <p>€1,200/mes</p>
          <p>Piso</p>
          <p>Alquiler</p>
          <p>20/9/2024</p>
        </aside>
      </article>
      <article>
        <figure>
          <img src="img/foto1.jpg" alt="Foto del anuncio 1" width="200" />
        </figure>
        <aside>
          <h2><a href="views/login.html">Título</a></h2>
          <p>Madrid</p>
          <p>€1,200/mes</p>
          <p>Piso</p>
          <p>Alquiler</p>
          <p>20/9/2024</p>
        </aside>
      </article>
      <article>
        <figure>
          <img src="img/foto1.jpg" alt="Foto del anuncio 1" width="200" />
        </figure>
        <aside>
          <h2><a href="views/login.html">Título</a></h2>
          <p>Madrid</p>
          <p>€1,200/mes</p>
          <p>Piso</p>
          <p>Alquiler</p>
          <p>20/9/2024</p>
        </aside>
      </article>
      <article>
        <figure>
          <img src="img/foto1.jpg" alt="Foto del anuncio 1" width="200" />
        </figure>
        <aside>
          <h2><a href="views/login.html">Título</a></h2>
          <p>Madrid</p>
          <p>€1,200/mes</p>
          <p>Piso</p>
          <p>Alquiler</p>
          <p>20/9/2024</p>
        </aside>
      </article>
    </section>
  </main>

  <p id="accesible">
    <a href="views/accesibilidad.php">Accesibilidad</a>
  </p>
  <footer>Todos los derechos reservados ©</footer>
</body>

</html>