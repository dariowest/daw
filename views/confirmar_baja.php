<?php
session_start();
include_once '../controller/connect.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usu'])) {
    header("Location: login.php");
    exit();
}

// Obtener los datos del usuario
$idUsuario = $_SESSION['id_usuario'];

$query = "SELECT COUNT(a.IdAnuncio) AS total_anuncios, 
                 COUNT(f.IdFoto) AS total_fotos 
          FROM anuncios a 
          LEFT JOIN fotos f ON a.IdAnuncio = f.Anuncio 
          WHERE a.Usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$resumen = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Confirmar Baja</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/darBaja.css" />
</head>
<body>

<?php include_once "../modules/cabecera.php"; ?>

<main>
  <h1>Confirmar Baja</h1>
  
  <section>
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

<footer>Todos los derechos reservados ©</footer>
</body>
</html>
