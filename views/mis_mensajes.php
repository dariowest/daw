<?php
session_start();
if (!isset($_SESSION["usu"])) {
  header("Location: login.php");
  exit();
}

include_once "../controller/connect.php";

$idUsuario = $_SESSION['id_usuario'];

// Obtener mensajes enviados
$queryEnviados = "SELECT t.NomTMensaje, m.Texto, m.FRegistro, u.NomUsuario AS Receptor 
                  FROM mensajes m 
                  JOIN usuarios u ON m.UsuarioDestino = u.IdUsuario 
                  JOIN tiposmensajes t ON m.TMensaje = t.IdTMensaje 
                  WHERE m.UsuarioOrigen = ? 
                  ORDER BY m.FRegistro DESC";
$stmtEnviados = $conn->prepare($queryEnviados);
$stmtEnviados->bind_param("i", $idUsuario);
$stmtEnviados->execute();
$mensajesEnviados = $stmtEnviados->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener mensajes recibidos
$queryRecibidos = "SELECT t.NomTMensaje, m.Texto, m.FRegistro, u.NomUsuario AS Emisor 
                   FROM mensajes m 
                   JOIN usuarios u ON m.UsuarioOrigen = u.IdUsuario 
                   JOIN tiposmensajes t ON m.TMensaje = t.IdTMensaje 
                   WHERE m.UsuarioDestino = ? 
                   ORDER BY m.FRegistro DESC";
$stmtRecibidos = $conn->prepare($queryRecibidos);
$stmtRecibidos->bind_param("i", $idUsuario);
$stmtRecibidos->execute();
$mensajesRecibidos = $stmtRecibidos->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mis Mensajes</title>
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
  <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
  <link rel="stylesheet" href="../styles/mis_mensajes.css" />
  <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
  <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
  <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
  <!-- Enlace a Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <?php
  include_once "../modules/cabecera.php"; 
  ?>

  <main>
    <h1>Mis Mensajes</h1>

    <h2>Mensajes Enviados</h2>
    <table>
      <thead>
        <tr>
          <th>Tipo de Mensaje</th>
          <th>Texto</th>
          <th>Fecha</th>
          <th>Receptor</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mensajesEnviados as $mensaje) : ?>
          <tr>
            <td><?= htmlspecialchars($mensaje['NomTMensaje']) ?></td>
            <td><?= htmlspecialchars($mensaje['Texto']) ?></td>
            <td><?= htmlspecialchars($mensaje['FRegistro']) ?></td>
            <td><?= htmlspecialchars($mensaje['Receptor']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Mensajes Recibidos</h2>
    <table>
      <thead>
        <tr>
          <th>Tipo de Mensaje</th>
          <th>Texto</th>
          <th>Fecha</th>
          <th>Emisor</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mensajesRecibidos as $mensaje) : ?>
          <tr>
            <td><?= htmlspecialchars($mensaje['NomTMensaje']) ?></td>
            <td><?= htmlspecialchars($mensaje['Texto']) ?></td>
            <td><?= htmlspecialchars($mensaje['FRegistro']) ?></td>
            <td><?= htmlspecialchars($mensaje['Emisor']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <footer>Todos los derechos reservados ©</footer>
</body>

</html>
