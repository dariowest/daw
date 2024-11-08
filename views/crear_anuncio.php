<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <title>Crear anuncio</title>
</head>
<body>
    <?php include_once "../modules/cabecera_log.php"?>

    <main>
        <h1>Crear anuncio</h1>
        <form action="">
            <div class="creanuncio">
                <label for="titulo">Titulo del anuncio</label>
                <input type="text">

            </div>
            <div class="creanuncio">
                <label for="tipo">Tipo de anuncio</label>
                <select name="tipo" id="">
                    <option value="alquiler">alquiler</option>
                    <option value="venta">venta</option>
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
                <select name="pais" id="">
                    <option value="españa">España</option>
                    <option value="francia">Francia</option>
                    <option value="holanda">Holanda</option>
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