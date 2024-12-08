<?php
session_start();
include_once '../controller/connect.php';

// Verificar sesión activa
if (!isset($_SESSION['usu'])) {
    header("Location: login.php");
    exit();
}

// Obtener datos del usuario
$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT COUNT(a.IdAnuncio) AS total_anuncios, 
                 COUNT(f.IdFoto) AS total_fotos 
          FROM anuncios a 
          LEFT JOIN fotos f ON a.IdAnuncio = f.Anuncio 
          WHERE a.Usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$resumen = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirmar baja</title>
    <link rel="stylesheet" href="../styles/darBaja.css" />
    <link rel="stylesheet" href="../styles/global.css" />
    <?php
    include_once("../modules/estilo.php");
    ?>
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <?php
    // Redirige al login si no hay sesión activa
    if (!isset($_SESSION["usu"])) {
        header("Location: login.php");
        exit();
    }

    include_once "../modules/cabecera.php";
    ?>
    <main>
        <section>
            <h2>Confirmar Baja</h2>
            <p><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION['usu']) ?></p>
            <p><strong>Número de anuncios:</strong> <?= htmlspecialchars($resumen['total_anuncios'] ?? 0) ?></p>
            <p><strong>Número de fotos:</strong> <?= htmlspecialchars($resumen['total_fotos'] ?? 0) ?></p>

            <form action="../controller/eliminar_usuario.php" method="POST">
                <p>Introduce tu contraseña para confirmar:</p>
                <input type="password" name="password" required />
                <input type="submit" value="Confirmar y eliminar mi cuenta" />
            </form>

            <a href="perfil.php">Cancelar</a>
        </section>
    </main>
</body>

</html>