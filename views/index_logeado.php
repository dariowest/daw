<?php
// Capturar los datos de la URL
if (isset($_GET['data'])) {
    $datos_usuario = json_decode(urldecode($_GET['data']), true);
}
?>

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
    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
    <title>Inicio</title>
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <?php include_once "../modules/cabecera_log.php" ?>

    <main>
        <header>
            <h3>Buscar</h3>
            <form action="res_busqueda.php" method="GET">
                <input type="text" name="ciudad" id="buscar" placeholder="Indique una ciudad"/>
                <input type="submit" value="Buscar" />
            </form>
            <h3>Últimas publicaciones</h3>
        </header>

        <!-- Muestro los datos del registro -->
        <div>
            <h3>Datos del registro:</h3>
            <?php if (isset($datos_usuario)): ?>
                <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($datos_usuario['usu']); ?></p>
                <p><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($datos_usuario['email']); ?></p>
            <?php else: ?>
                <p>No se han recibido datos de registro.</p>
            <?php endif; ?>
        </div>

        <?php include_once "../modules/muestra_anuncios.php" ?>
    </main>

    <footer>Todos los derechos reservados ©</footer>
</body>
</html>
