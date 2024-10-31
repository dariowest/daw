<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../styles/global.css" />
    <link rel="stylesheet" href="../styles/error.css" />
    <link rel="stylesheet" href="../styles/estilo-estandar.css" title="Estilo principal" />
    <link rel="alternative stylesheet" href="../styles/oscuro.css" title="Modo oscuro" />
    <link rel="stylesheet" href="../styles/form-buscar.css" />
    <link rel="alternative stylesheet" href="../styles/contraste.css" title="Estilo alto contraste" />
    <link rel="alternative stylesheet" href="../styles/letra-mayor.css" title="Estilo letra mayor" />
    <link rel="alternative stylesheet" href="../styles/contraste-letra.css"
        title="Estilo letra mayor y alto contraste" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head <body>
<header>
    <nav>
        <img src="../img/small_logo.png" alt="logo" />
        <ul>
            <li><a href="../index.html"><i class="fas fa-home"></i> <span>Inicio</span></a></li>
            <li><a href="form_busqueda.html"><i class="fas fa-search"></i> <span>Buscar</span></a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> <span>Inicio sesión</span></a></li>
            <li><a href="registro.html"><i class="fas fa-user-plus"></i> <span>Registro</span></a></li>
        </ul>
    </nav>
</header>

<main>
    <form id="registration-form" action="../php/validacionLogin.php" method="POST">
        <h3>Iniciar Sesión</h3>

        <!--Gestión de errores-->
        <?php
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case '1': //en caso de que el input no sea el correcto
                    echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
                    break;
                case '2': //caso en que haya espacios o tabs en el login
                    echo "<p style='color:red;'>El nombre de usuario y la contraseña no deben contener espacios.</p>";
                    break;
                case '3':
                    echo "<p style='color:red;'>El nombre de usuario y la contraseña no pueden estar vacíos.</p>";
                    break;
                case '4':
                    echo "<p style='color:red;'>El nombre de usuario y la contraseña no deben contener caracteres especiales como ñ o tildes.</p>";
                    break;
            }
        }
        ?>

        <div class="form-alineado">
            <label for="usu">Nombre de usuario:</label>
            <input id="usu" name="usu" autofocus maxlength="20" />
        </div>

        <div class="form-alineado">
            <label for="pwd">Contraseña:</label>
            <input type="password" id="pwd" name="pwd" maxlength="20" />
        </div>

        <div class="form-alineado">
            <input type="submit" value="Iniciar sesión" />
        </div>

        <div class="form-alineado">
            <p>¿No tienes una cuenta? <a href="registro.html">Regístrate</a></p>
        </div>
    </form>
</main>

<footer>Todos los derechos reservados ©</footer>
</body>

</html>