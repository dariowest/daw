<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir foto</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <?php 
    session_start();
    if (!isset($_SESSION["usu"])){
        header("Location: login.php");

    }
    include_once "../modules/cabecera.php"?>

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
                    if(!isset($_GET["id"])){
                    ?>

                    <option value="">Selecciona una opción</option>
                    <option value="anuncio1" id="1">Anuncio1</option>
                    <option value="anuncio2" id="2">Anuncio2</option>
                    <option value="anuncio3" id="3">Anuncio3</option>
                    <?php }
                    else{
                        $id = $_GET["id"];

                        for($i = 1; $i <= 10; $i++){
                            if($i == $id){
                                echo"<option value=\"anuncio$i\" id=\"$i\" selected>Anuncio$i</option>";
                                
                            }
                            else{
                                echo"<option value=\"anuncio$i\" id=\"$i\">Anuncio$i</option>";

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