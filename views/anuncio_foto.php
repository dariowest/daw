<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir foto</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <?php
  include_once ("../modules/estilo.php");
  ?>
</head>
<body>
    <?php 
    if (!isset($_SESSION["usu"])){
        header("Location: login.php");

    }
    include_once "../modules/cabecera.php";
    include_once "../controller/connect.php";
    ?>

    <main>
        <h1>Añade una foto</h1>
        <form action="">
            <div class="creafoto">
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo">
            </div>
            <div class="creafoto">
                <label for="alternativo">Alternativo</label>
                <input type="text" name="alternativo" minlength="10">

            </div>
            <div class="creafoto">
                <label for="foto">Foto</label>
                <input type="file" name="foto">
            </div>
            <div class="creafoto">
                <label for="anuncio">Anuncio</label>
                <select name="anuncio">
                    <?php
                    $sql = "SELECT IdAnuncio, Titulo FROM anuncios where Usuario = ".$_SESSION['id_usuario'];
                    $result = $conn->query($sql);
                    

                    if(!isset($_GET["id"])){
                    echo"<option value'' selected>Selecciona un anuncio</option>";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IdAnuncio"] . '">' . $row["Titulo"] . '</option>';
                        }
                        }

                    }
                    else{
                        $id = $_GET["id"];

                        while ($row = $result->fetch_assoc()){
                            if($row["IdAnuncio"] == $id){
                                echo"<option value='{$row["IdAnuncio"]}' selected>{$row["Titulo"]}</option>";
                                
                            }
                            else{
                                echo"<option value='{$row["IdAnuncio"]}'>{$row["Titulo"]}</option>";

                            }

                        }


                    }

                    ?>
                </select>
            </div>

        </form>
    </main>

    
</body>
</html>