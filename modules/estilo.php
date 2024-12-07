<?php


$currentFile = basename($_SERVER['PHP_SELF']);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Comprobar si no es index.php
if ($currentFile === 'index.php') {
    include_once "controller/connect.php";

    if (isset($_SESSION["usu"])) {
        $sql = "SELECT Estilo FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Estilo'] == 1) {
                    ?>

                    <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 2) {
                    ?>

                    <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 3) {
                    ?>

                    <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 4) {
                    ?>

                    <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
                    <?php
                }
                if ($row['Estilo'] == 5) {
                    ?>

                    <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
                    <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
            }
        }


    } else {
        ?>
        <link rel="stylesheet" href="styles/estilo-estandar.css" title="Estilo principal" />
        <link rel="alternative stylesheet" href="styles/oscuro.css" title="Modo oscuro" />
        <link rel="alternative stylesheet" href="styles/contraste.css" title="Estilo alto contraste" />
        <link rel="alternative stylesheet" href="styles/letra-mayor.css" title="Estilo letra mayor" />
        <link rel="alternative stylesheet" href="styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
        <?php
    }

} else {
    include_once "../controller/connect.php";

    if (isset($_SESSION["usu"])) {
        $sql = "SELECT Estilo FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Estilo'] == 1) {
                    ?>

                    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 2) {
                    ?>

                    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 3) {
                    ?>

                    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
                if ($row['Estilo'] == 4) {
                    ?>

                    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
                    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
                    <?php
                }
                if ($row['Estilo'] == 5) {
                    ?>

                    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
                    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
                    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
                    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
                    <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
                    <?php
                }
            }
        }


    } else {
        ?>
        <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
        <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
        <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
        <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
        <link rel="alternative stylesheet" href="../styles/contraste-letra.css" title="Estilo letra mayor y alto contraste" />
        <?php
    }

}
?>