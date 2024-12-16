<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Crear anuncio</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["usu"])) {
        header("Location: login.php");
    }
    include_once "../modules/cabecera.php";
    include_once "../controller/connect.php";
    ?>

    <main>
        <h1>Crear anuncio</h1>
        
        <!-- Cambiamos GET a POST y añadimos enctype para subir archivos -->
        <form action="../controller/res_creaAnuncio.php" method="POST" enctype="multipart/form-data">
            <div class="creanuncio">
                <label for="titulo">Título del anuncio</label>
                <input type="text" name="titulo" required>
            </div>
            
            <div class="creanuncio">
                <label for="tipo">Tipo de anuncio</label>
                <select name="tipo">
                    <?php
                    $sql = "SELECT IdTAnuncio, NomTAnuncio FROM tiposanuncios";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdTAnuncio"] . '">' . $row["NomTAnuncio"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="creanuncio">
                <label for="precio">Precio</label>
                <input type="number" name="precio">
            </div>

            <div class="creanuncio">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad">
            </div>

            <div class="creanuncio">
                <label for="pais">País</label>
                <select name="pais">
                    <?php
                    $sql = "SELECT IdPais, NomPais FROM paises";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdPais"] . '">' . $row["NomPais"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="creanuncio">
                <label for="tipoVivienda">Tipo de vivienda</label>
                <select name="tipoVivienda">
                    <?php
                    $sql = "SELECT IdTVivienda, NomTVivienda FROM tiposviviendas";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdTVivienda"] . '">' . $row["NomTVivienda"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="creanuncio">
                <label for="descripcion">Descripción del anuncio</label>
                <textarea name="descripcion" rows="5" required></textarea>
            </div>

            <div class="creanuncio">
                <label for="foto">Imagen principal</label>
                <input type="file" name="foto" accept="image/*">
            </div>

            <input type="submit" value="Crear Anuncio">
        </form>

    </main>
</body>

</html>
