<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Iniciar sesión para almacenar errores y datos

    include_once '../controller/connect.php';

    $errores = [];
    $usuario = trim($_POST['usu'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contraseña = $_POST['pwd'] ?? '';
    $confirmar_contraseña = $_POST['pwd2'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $ciudad = trim($_POST['ciudad'] ?? '');
    $foto = $_FILES['foto'] ?? null;

    // 🔍 **Validaciones**

    // Validar nombre de usuario
    if (empty($usuario) || !preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,14}$/', $usuario)) {
        $errores['usu'] = "El nombre de usuario debe comenzar con una letra, tener entre 3 y 15 caracteres, y solo letras o números.";
    }

    // Validar correo electrónico
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "El correo electrónico no es válido.";
    }

    // Validar contraseña
    if (empty($contraseña) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d_-]{6,15}$/', $contraseña)) {
        $errores['pwd'] = "La contraseña debe tener entre 6 y 15 caracteres, incluir una mayúscula, una minúscula y un número.";
    }

    // Confirmar contraseña
    if ($contraseña !== $confirmar_contraseña) {
        $errores['pwd2'] = "Las contraseñas no coinciden.";
    }

    // Validar sexo
    if (empty($sexo)) {
        $errores['sexo'] = "El sexo es obligatorio.";
    }

    // Validar fecha de nacimiento
    $fecha_actual = new DateTime();
    $fecha_nac = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
    if (!$fecha_nac || $fecha_actual->diff($fecha_nac)->y < 18) {
        $errores['fecha_nacimiento'] = "Debes ser mayor de 18 años.";
    }

    // Validar país
    if (empty($pais)) {
        $errores['pais'] = "El país es obligatorio.";
    }

    // Validar ciudad
    if (empty($ciudad)) {
        $errores['ciudad'] = "La ciudad es obligatoria.";
    } elseif (!preg_match('/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/', $ciudad)) {
        $errores['ciudad'] = "La ciudad solo puede contener letras y espacios.";
    }

    $foto_nombre = null;

    if ($foto && $foto['error'] === 0) {
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
    
        // Validar la extensión del archivo
        if (!in_array($extension, $extensiones_permitidas)) {
            $errores['foto'] = "Formato de foto no válido. Solo JPG, JPEG, PNG y GIF.";
        } else {
            // Verificar si la carpeta "img" existe, si no, crearla
            if (!is_dir('../img')) {
                mkdir('../img', 0775, true);
            }
    
            // Evitar colisión de nombres de archivo
            $foto_nombre = uniqid('perfil_', true) . "." . $extension;
            $ruta_foto = "../img/" . $foto_nombre;
    
            // Intentar mover la foto a la carpeta
            if (!move_uploaded_file($foto['tmp_name'], $ruta_foto)) {
                error_log("Error al mover el archivo: " . print_r($foto, true));
                $errores['foto'] = "No se pudo subir la foto. Inténtalo de nuevo.";
            }
        }
    } else {
        // Verificar si ocurrió un error en la subida
        if ($foto['error'] !== UPLOAD_ERR_NO_FILE) {
            $errores['foto'] = "Error en la subida del archivo: " . $foto['error'];
        }
    }
    

    // 🚀 **Inserción en la base de datos**
    if (empty($errores)) {
<<<<<<< HEAD
        // Verifica los nombres reales de las columnas en tu tabla `Usuarios`
        $query = "INSERT INTO Usuarios (NomUsuario, Email, Clave, Sexo, FNacimiento, Pais, Ciudad, Foto) 
=======
        $query = "INSERT INTO usuarios (NomUsuario, Email, Clave, Sexo, FNacimiento, Pais, Ciudad, Foto) 
>>>>>>> origin/rama_juanjo
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // ⚠️ Nota: La contraseña se guarda como texto plano (NO RECOMENDADO en producción)
        $stmt->bind_param("ssssssss", $usuario, $email, $contraseña, $sexo, $fecha_nacimiento, $pais, $ciudad, $foto_nombre);

        if ($stmt->execute()) {
            header("Location: ../views/login.php?success=1");
            exit();
        } else {
            $errores['general'] = "Error al registrar el usuario. Intente más tarde.";
        }
    }

    // Guardar errores y datos en la sesión y redirigir de vuelta al formulario
    $_SESSION['errores'] = $errores;
    $_SESSION['datos'] = $_POST; // Incluye todos los datos enviados excepto la contraseña
    header("Location: ../views/registro.php");
    exit();
}
