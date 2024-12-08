<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Editar anuncio</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["usu"])) {
        header("Location: login.php");

    }
    include_once "../modules/cabecera.php";
    include_once "../controller/connect.php";

    $sql2 = "SELECT TAnuncio, TVivienda, Titulo, Precio, Texto, Ciudad, Pais, Nhabitaciones, Nbanyos, Planta FROM anuncios WHERE IdAnuncio = ".$_GET["id"];
    
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        // output data of each row
        while ($row2 = $result2->fetch_assoc()) {
            



    ?>

    <main>
        <h1>Editar anuncio</h1>
        <form action="../controller/res_editar_anuncio.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <div class="creanuncio">
                <label for="titulo">Titulo del anuncio</label>
                <input type="text" name="titulo" value="<?php echo $row2["Titulo"]; ?>">

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
                            if($row["IdTAnuncio"]==$row2["TAnuncio"]){
                                echo '<option value="' . $row["IdTAnuncio"] . '"selected>' . $row["NomTAnuncio"] . '</option>';
                            }
                            else{
                                echo '<option value="' . $row["IdTAnuncio"] . '">' . $row["NomTAnuncio"] . '</option>';
                            }
                        }
                    }

                    ?>
                </select>


            </div>
            <div class="creanuncio">
                <label for="precio">Precio</label>
                <input type="number" name="precio" value="<?php echo $row2["Precio"]; ?>">

            </div>
            <div class="creanuncio">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" value="<?php echo $row2["Ciudad"]; ?>">

            </div>
            <div class="creanuncio">
                <label for="pais">Pais</label>
                <select name="pais">
                    <?php
                    $sql = "SELECT IdPais, NomPais FROM paises";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if($row["IdPais"]==$row2["Pais"]){
                                echo '<option value="' . $row["IdPais"] .'"selected>' . $row["NomPais"] . '</option>';
                            }
                            else{
                                echo '<option value="' . $row["IdPais"] .'">' . $row["NomPais"] . '</option>';
                            }
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
                            if($row["IdTVivienda"]==$row2["TVivienda"]){
                                echo '<option value="' . $row["IdTVivienda"] . '"selected>' . $row["NomTVivienda"] . '</option>';
                            }
                            else{
                                echo '<option value="' . $row["IdTVivienda"] . '">' . $row["NomTVivienda"] . '</option>';

                            }
                        }
                    } else {
                        echo '<option value="" disabled selected>No hay anuncios</option>';
                    }

                    ?>

                </select>

            </div>

            <div class="creanuncio">
                <label for="habitaciones">Numero de habitaciones</label>
                <input type="number" name="habitaciones" id="habitaciones" value="<?php echo $row2["Nhabitaciones"]; ?>">
            </div>
            <div class="creanuncio">
                <label for="banyo">Numero de baños</label>
                <input type="number" name="banyo" id="banyo" value="<?php echo $row2["Nbanyos"]; ?>">
            </div>
            <div class="creanuncio">
                <label for="planta">Numero de plantas</label>
                <input type="number" name="planta" id="planta" value="<?php echo $row2["Planta"]; ?>">
            </div>

            <div class="creanuncio">
                <label for="descripcion">Descripcion del anuncio</label>
                <textarea name="descripcion" rows="5"><?php echo $row2["Texto"]; ?></textarea>
            </div>
            <input type="submit" value="Cambiar">

        </form>

    </main>
    <?php
        }
    }
    
    ?>

</body>

</html>