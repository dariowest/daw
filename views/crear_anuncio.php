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
        <form action="" >
            <div class="creanuncio">
                <label for="titulo">Titulo del anuncio</label>
                <input type="text">

            </div>
            <div class="creanuncio">
                <label for="tipo">Tipo de anuncio</label>
                <select name="tipo">
                    <?php
                    $sql = "SELECT IdTAnuncio, NomTAnuncio FROM tiposanuncios";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdTAnuncio"] . '">' . $row["NomTAnuncio"] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled selected>No hay anuncios</option>';
                    }

                    ?>
                </select>


            </div>
            <div class="creanuncio">
                <label for="precio">Precio</label>
                <input type="number">

            </div>
            <div class="creanuncio">
                <label for="ciudad">Ciudad</label>
                <select name="ciudad" id="">
                    <option value="madrid">Madrid</option>
                    <option value="alicante">Alicante</option>
                    <option value="valencia">Valencia</option>
                </select>

            </div>
            <div class="creanuncio">
                <label for="pais">Pais</label>
                <select name="pais">
                    <?php
                    $sql = "SELECT IdPais, NomPais FROM paises";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdPais"] . '">' . $row["NomPais"] . '</option>';
                        }
                    } else {
                        echo "0 results";
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
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdTVivienda"] . '">' . $row["NomTVivienda"] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled selected>No hay anuncios</option>';
                    }

                    ?>

                </select>

            </div>

            <div class="creanuncio">
                <label for="descripcion">Descripcion del anuncio</label>
                <textarea name="descripcion" id="" rows="5"></textarea>
            </div>
            <input type="submit">

        </form>

    </main>

</body>

</html>