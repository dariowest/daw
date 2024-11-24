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
  <?php
  session_start();

  // Leer configuración desde config.ini
  $config = parse_ini_file('config.ini', true);

  // Conectar a la base de datos
  $mysqli = new mysqli(
    $config['DB']['Server'],
    $config['DB']['User'],
    $config['DB']['Password'],
    $config['DB']['Database']
  );

  // Comprobar conexión
  if ($mysqli->connect_error) {
    die("Error al conectar a la base de datos: " . $mysqli->connect_error);
  }

  // Consulta para obtener los últimos 5 anuncios
  $query = "
    SELECT 
        a.IdAnuncio, 
        a.Titulo, 
        a.Ciudad, 
        a.Precio, 
        tA.NomTAnuncio AS TipoAnuncio, 
        tV.NomTVivienda AS TipoVivienda, 
        a.Foto, 
        a.FRegistro 
    FROM Anuncios a
    JOIN TiposAnuncios tA ON a.TAnuncio = tA.IdTAnuncio
    JOIN TiposViviendas tV ON a.TVivienda = tV.IdTVivienda
    ORDER BY a.FRegistro DESC 
    LIMIT 5";


  $result = $mysqli->query($query);

  // Verificar si hay resultados
  if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
  }

  // Pasar los datos a una variable para incluirlos en muestra_index.php
  $anuncios = $result->fetch_all(MYSQLI_ASSOC);

  include_once "modules/cabecera_index.php";
  ?>

  <main>
    <header>
      <h3>Buscar</h3>
      <form action="views/res_busqueda.php" method="GET">
        <input type="text" name="ciudad" id="buscar" placeholder="Indique una ciudad" />
        <input type="submit" value="Buscar" />
      </form>
      <h3>Últimas publicaciones</h3>
    </header>
    <?php
    if (isset($_SESSION['usu'])) {
    ?>
      <div style="margin-left: 150px;">
        <h3>Datos del registro:</h3>
        <p><strong>Nombre de usuario:</strong> <?php echo $_SESSION['usu']; ?></p>
      </div>
    <?php
    }
    include_once("modules/muestra_index.php");
    ?>
  </main>

  <p id="accesible">
    <a href="views/accesibilidad.php">Accesibilidad</a>
  </p>
  <footer>Todos los derechos reservados ©</footer>
</body>

</html>