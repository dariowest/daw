<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <script src="../js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="../styles/global.css" />
    <link rel="stylesheet" href="../styles/error.css" />
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
    <link rel="stylesheet" href="../styles/form-buscar.css" />
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
    <header>
      <nav>
        <img src="../img/small_logo.png" alt="logo" />
        <ul>
          <li>
            <a href="../index.html"
              ><i class="fas fa-home"></i> <span>Inicio</span></a
            >
          </li>
          <li>
            <a href="form_busqueda.html"
              ><i class="fas fa-search"></i> <span>Buscar</span></a
            >
          </li>
          <li>
            <a href="login.html"
              ><i class="fas fa-sign-in-alt"></i> <span>Inicio sesión</span></a
            >
          </li>
          <li>
            <a href="registro.html"
              ><i class="fas fa-user-plus"></i> <span>Registro</span></a
            >
          </li>
        </ul>
      </nav>
    </header>
    <main>
      <form
        id="registration-form"
        action="index_logeado.html"
        onsubmit="validarFormularioRegistro(event)">
        <h3>Registrar Usuario</h3>

        <!-- Nombre de usuario -->
        <div class="form-alineado">
          <label for="usu">Nombre de usuario:</label>
          <input
            id="usu"
            name="usu"
            autofocus
            maxlength="20"
            title="No se permiten espacios en blanco, una longitud de 4 a 20 caracteres y solo se podrán usar números y letras (mayusculas y minùsculas), además de que no se puede iniciar con números."
          />
        </div>
        <div class="form-alineado">
          <label for="email">Correo electrónico:</label>
          <input id="email" name="email" title="Falta el @." />
        </div>
        <div class="form-alineado">
          <label for="pwd">Contraseña:</label>
          <input
            id="pwd"
            name="pwd"
            maxlength="20"
            title="No debe tener espacios en blanco y sólo se pueden utilizar letras mayúsculas, minúsculas, números y los caracteres “_”, “-” y “.”. Su longitud no puede ser menor de 4 ni mayor de 20 caracteres."
          />
        </div>
        <div class="form-alineado">
          <label for="pwd2">Confirmar contraseña:</label>
          <input id="pwd2" name="pwd2" />
        </div>
        <div class="form-alineado">
          <label for="sexo">Sexo:</label>
          <select id="sexo" name="sexo">
            <option value="">Selecciona tu sexo</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
          </select>
        </div>
        <div class="form-alineado">
          <label for="fecha_nacimiento">Fecha de nacimiento:</label>
          <input id="fecha_nacimiento" name="fecha_nacimiento" />
        </div>
        <div class="form-alineado">
          <label for="ciudad">Ciudad de residencia:</label>
          <input
            id="ciudad"
            name="ciudad"
            title="Solo se permiten letras y espacios. Mínimo 2 caracteres."
          />
        </div>
        <div class="form-alineado">
          <label for="pais">País de residencia:</label>
          <input
            id="pais"
            name="pais"
            title="Solo se permiten letras y espacios. Mínimo 2 caracteres."
          />
        </div>
        <div class="form-alineado">
          <label for="foto_perfil">Foto de perfil:</label>
          <input id="foto_perfil" name="foto_perfil" accept="image/*" />
        </div>
        <div class="form-alineado">
          <input type="submit" value="Registrar" />
        </div>
        <div class="form-alineado"></div>
      </form>
    </main>

    <footer>Todos los derechos reservados ©</footer>
    <script>
      document.addEventListener("DOMContentLoaded", establecerTiposFormulario);
    </script>
  </body>
</html>
