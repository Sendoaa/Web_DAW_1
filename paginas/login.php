<?php
// Función para limpiar datos de entrada
function limpiar_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Ruta del archivo XML
$ruta_xml = "../xm_xs/temporada.xml";

// Verificar si el archivo XML existe y se puede leer
if (file_exists($ruta_xml)) {
    // Cargar el archivo XML
    $xml = simplexml_load_file($ruta_xml);
    
    // Verificar si se cargó correctamente el archivo XML
    if ($xml !== false) {
        // Convertir el XML en un array asociativo para usuarios administradores
        $usuarios_admin = [];
        foreach ($xml->usuarios->admin as $admin) {
            $usuario = limpiar_input((string) $admin->usuario);
            $contraseña = limpiar_input((string) $admin->contraseña);
            $usuarios_admin[$usuario] = $contraseña;
        }

        // Convertir el XML en un array asociativo para usuarios invitados
        $usuarios_invitado = [];
        foreach ($xml->usuarios->invitado as $invitado) {
            $usuario = limpiar_input((string) $invitado->usuario);
            $contraseña = limpiar_input((string) $invitado->contraseña);
            $usuarios_invitado[$usuario] = $contraseña;
        }
    } else {
        die("Error al cargar el archivo XML");
    }
} else {
    die("El archivo XML no existe o no se puede leer");
}

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre']) && isset($_POST['contraseña'])) {
        $usuario = limpiar_input($_POST['nombre']);
        $contraseña = limpiar_input($_POST['contraseña']);

        // Verificar si el usuario existe y la contraseña es correcta
        if (isset($usuarios_admin[$usuario]) && $contraseña == $usuarios_admin[$usuario]) {
            session_start(); // Iniciar la sesión
            $_SESSION['usuario'] = $usuario;
            header("Location: ../index.php");
            exit;
        } elseif (isset($usuarios_invitado[$usuario]) && $contraseña == $usuarios_invitado[$usuario]) {
            session_start(); // Iniciar la sesión
            $_SESSION['usuario'] = $usuario;
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Nombre de usuario o contraseña incorrectos";
        }
    } else {
        $error = "Por favor, rellena todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOF</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="./imagenes/logos/nofondo.png">
</head>
<body>
<header>
    <div class="left-section">
        <a href="./index.php"><img src="../imagenes/logos/BOFlogo.png" alt=""></a>
    </div>
    <div class="togglearea">
        <label for="toggle">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>
    <input type="checkbox" id="toggle">
    <div class="navbar">
        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
        <a <?php echo ($currentPage == 'index.php') ? 'id="active"' : ''; ?> href="../index.php">Inicio</a>
        <a <?php echo ($currentPage == 'calendario.php') ? 'id="active"' : ''; ?> href="../paginas/calendario.php">Calendario</a>
        <a <?php echo ($currentPage == 'clasi.php') ? 'id="active"' : ''; ?> href="../paginas/clasi.php">Clasificación</a>
        <a <?php echo ($currentPage == 'datos.php') ? 'id="active"' : ''; ?> href="../paginas/datos.php">Equipos</a>
        <a <?php echo ($currentPage == 'noticias.php') ? 'id="active"' : ''; ?> href="../paginas/noticias.php">Noticias</a>
        <a <?php echo ($currentPage == 'contacto.php') ? 'id="active"' : ''; ?> href="../paginas/contacto.php">Contacto</a>
    </div>
</header>
    <!-- Formulario de inicio de sesión -->
    <article class="posicion-container-login">
        <div class="container">
            <div class="login-container">
                <div class="login-img">
                    <img src="../imagenes/logos/BOFlogoGrande.png" alt="" class="tamano-img">
                </div>
                <form action="../paginas/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="nombre" class="entradatext" required placeholder="Nombre de usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" name="contraseña" class="entradatext" required placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">Iniciar Sesión</button>
                    </div>
                    <?php if (isset($error)) { ?>
                        <div class="form-group">
                            <p><?php echo $error; ?></p>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </article>

    <!-- Pie de página -->
    <footer class="footer">
        <div>
            <ul>
                <li><img src="../imagenes/logos/BOFlogo.png" alt="" class="logopie"></li>
                <li><p>© 2023 NSLA Enterprises LLC. NSLA and the NSLA shield design are registered trademarks of the National Football League.The team names, logos and uniform designs are registered trademarks of the teams indicated. All other NSLA-related trademarks are trademarks of the National Football League. NSLA footage © NSLA Productions LLC.</p></li>
                <li class="terms">
                    <a href="./paginas/privacidad.html">Política de Privacidad</a>
                    <a href="./paginas/terminos.html">Terminos de Servicio</a>
                    <a href="">Términos y Condiciones de Subscripción</a>
                    <a href="">Tus Ajustes de Privacidad</a>
                    <a href="">Ajustes de Cookies</a>
                </li>
            </ul>
        </div>
    </footer>
</body>
</html>
