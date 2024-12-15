<?php
session_start();
if (!isset($_SESSION["usu"])) {
    header("Location: login.php");
    exit();
}

include_once "../controller/connect.php";

// Obtener la lista de anuncios del usuario
$queryAnuncios = "SELECT IdAnuncio, Titulo FROM anuncios WHERE Usuario = ?";
$stmt = $conn->prepare($queryAnuncios);
$idUsuario = $_SESSION['id_usuario'];
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultAnuncios = $stmt->get_result();
$anuncios = $resultAnuncios->fetch_all(MYSQLI_ASSOC);

// Capturar errores de la sesión si los hay
$errores = $_SESSION['errores'] ?? [];
unset($_SESSION['errores']); // Limpiar errores de la sesión para la próxima vez
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir foto</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/form-buscar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <?php include_once("../modules/estilo.php"); ?>
</head>
<body>

    <?php include_once "../modules/cabecera.php"; ?>

    <main>
        <h1>Añade una foto</h1>

        <!-- Mostrar errores -->
        <?php if (!empty($errores)): ?>
            <div class="errores">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="../controller/res_foto.php" method="POST" enctype="multipart/form-data">
            <div class="creafoto">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>" maxlength="50">
            </div>
            <div class="creafoto">
                <label for="alternativo">Texto alternativo</label>
                <input type="text" name="alternativo" value="<?= htmlspecialchars($_POST['alternativo'] ?? '') ?>" minlength="10" maxlength="100">
            </div>
            <div class="creafoto">
                <label for="foto">Foto</label>
                <input type="file" name="foto" accept="image/jpeg, image/png, image/gif">
            </div>
            <div class="creafoto">
                <label for="anuncio">Anuncio</label>
                <select name="anuncio">
                    <option value="">Selecciona un anuncio</option>
                    <?php foreach ($anuncios as $anuncio): ?>
                        <option value="<?= $anuncio['IdAnuncio'] ?>" 
                            <?= (isset($_GET['id']) && $_GET['id'] == $anuncio['IdAnuncio']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($anuncio['Titulo']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="creafoto">
                <input type="submit" value="Subir Foto">
            </div>
        </form>
    </main>

</body>
</html>
