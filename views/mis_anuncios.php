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
    <?php
    session_start();
    if (!isset($_SESSION["usu"])) {
        header("Location: login.php");

    }
    include_once "../modules/cabecera.php";
    include_once "../controller/connect.php"; ?>

    <main>
        <header>
            <h1>Mis publicaciones</h1>
        </header>
        <section>

            
            <?php
        $sql = "
        SELECT 
            a.IdAnuncio, 
            a.Titulo, 
            a.Ciudad, 
            a.Precio, 
            tA.NomTAnuncio AS TipoAnuncio, 
            tV.NomTVivienda AS TipoVivienda, 
            a.Foto, 
            a.FRegistro,
            p.NomPais AS Pais
        FROM anuncios a
        JOIN tiposanuncios tA ON a.TAnuncio = tA.IdTAnuncio
        JOIN tiposviviendas tV ON a.TVivienda = tV.IdTVivienda
        JOIN paises p ON a.Pais = p.IdPais
        WHERE a.Usuario = ".$_SESSION['id_usuario'];
        $result = $conn->query($sql);
        
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<article>';
                echo '<figure>';
                echo "<img src='../img/{$row['Foto']}' alt='Foto del anuncio {$row['IdAnuncio']}' width='200' />";
                echo '</figure>';
                echo '<aside>';
                    echo "<h2><a href='anuncio.php?id={$row['IdAnuncio']}'>{$row['Titulo']}</a></h2>";
                    echo "<p>{$row['Pais']}</p>";
                    echo "<p>{$row['Ciudad']}</p>";
                    echo "<p>{$row['Precio']}</p>";
                    echo "<p>{$row['TipoVivienda']}</p>";
                    echo "<p>{$row['FRegistro']}</p>";

                echo '</aside>';
                echo '</article>';
                }
            } else {
                echo '<p>No hay anuncios</p>';
            }
            /*
            <article>
            <figure>
            <img src="<?= $anuncio['imagen'] ?>" alt="Foto del anuncio <?= $anuncio['id'] ?>" width="200" />
            </figure>
            <aside>
            <h2><a href="anuncio.php?id=<?= $anuncio['id'] ?>"><?= $anuncio['titulo'] ?></a></h2>
            <p><?= $anuncio['pais'] ?></p>
            <p><?= $anuncio['ciudad'] ?></p>
            <p><?= $anuncio['precio'] ?></p>
            <p><?= $anuncio['tipoVivienda'] ?></p>
            <p><?= $anuncio['tipoAnuncio'] ?></p>
            <p><?= $anuncio['fecha'] ?></p>
            </aside>
        </article>
        */
        ?>
        
        
    </section>
    </main>
    <footer>Todos los derechos reservados ©</footer>
</body>

</html>