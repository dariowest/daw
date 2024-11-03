<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../styles/global.css" />
    <script src="../js/script.js"></script>
    <link
      rel="stylesheet"
      href="../styles/estilo-estandar.css"
      title="Estilo principal"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/oscuro.css"
      title="Modo oscuro"
    />
    <link rel="stylesheet" href="../styles/form-buscar.css" />
    <link
      rel="alternative stylesheet"
      href="../styles/contraste.css"
      title="Estilo alto contraste"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/letra-mayor.css"
      title="Estilo letra mayor"
    />
    <link
      rel="alternative stylesheet"
      href="../styles/contraste-letra.css"
      title="Estilo letra mayor y alto contraste"
    />
    <!-- Enlace a Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <body>
    <?php include_once "../modules/cabecera_unlog.php"?>

    <main>
      <form id="registration-form" action="index_logeado.php">
        <h3>Iniciar Sesión</h3>
        <div class="form-alineado">
          <label for="usu">Nombre de usuario:</label>
          <input
            id="usu"
            name="usu"
            autofocus
            maxlength="20"
            title="No se permiten espacios en blanco, una longitud de 
              4 a 20 caracteres y solo se podrán usar números y letras (mayusculas y minùsculas), además de que no se puede iniciar con números."
          />
        </div>

        <div class="form-alineado">
          <label for="pwd">Contraseña:</label>
          <input
            id="pwd"
            name="pwd"
            maxlength="20"
            title="No debe tener espacios en blanco y sólo se pueden
              utilizar letras mayúsculas, minúsculas, números y los caracteres “_”, “-” y “.”. Su longitud no puede ser menor de 4 ni mayor de 20 caracteres."
          />
        </div>

        <div class="form-alineado">
          <input type="submit" value="Iniciar sesion" />
        </div>

        <div class="form-alineado">
          <p>¿No tienes una cuenta? <a href="registro.php">Registrate</a></p>
        </div>
      </form>
    </main>

    <footer>Todos los derechos reservados ©</footer>
  </body>
</html>
