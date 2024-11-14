<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/global.css" />
    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
    <link rel="stylesheet" href="../styles/imprime-index.css" media="print" />
    <link rel="alternative stylesheet" href="../styles/contraste-letra.css"
        title="Estilo letra mayor y alto contraste" />
    <title>Mis anuncios</title>
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <?php include_once "../modules/cabecera_log.php" ?>

    <main>
        <header>
            <h1>Mis publicaciones</h1>
        </header>

        <?php include_once "../modules/muestra_anuncios.php" ?>

    </main>
    <footer>Todos los derechos reservados ©</footer>
</body>

</html>