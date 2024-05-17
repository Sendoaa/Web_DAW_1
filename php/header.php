<?php
// Iniciar la sesión
session_start();

// Verificar si el parámetro 'logout' está presente en la URL
if (isset($_GET['logout'])) {
    // Destruir todas las variables de sesión.
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, eliminar también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();
    // Redirigir al usuario a la misma página para eliminar el parámetro 'logout' de la URL
    header("Location: ../paginas/login.php");
    exit;
}



// Variable para indicar si el usuario está conectado
$loggedIn = false;
$esAdmin = false;
$esInvitado = false;

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    $loggedIn = true;
    // Aquí puedes realizar cualquier otra comprobación necesaria, como si el usuario es administrador o invitado
    // Por ahora, vamos a asumir que es un administrador si el usuario es 'admin' y un invitado si el usuario es 'invitado'
    if ($_SESSION['usuario'] == 'admin') {
        $esAdmin = true;
    } elseif ($_SESSION['usuario'] == 'invitado') {
        $esInvitado = true;
    }
  } else {
    // Si el usuario no ha iniciado sesión, redirigir a login.php
    echo "<script>alert('Tiene que iniciar sesion.'); window.location.href='./login.php';</script>";
    header("Location: ./login.php");
    exit;
}




?>

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
        <?php if ($loggedIn) : ?>
            <?php if ($esAdmin) : ?>
                <div class="imagen-usuario"><img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Administrador"></div>
                <div id="dropdownMenu" style="display: none;">
                    <h1>ADMIN</h1>
                    <a href="../paginas/admin.php">Mi cuenta</a>
                    <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
                </div>
            <?php elseif ($esInvitado) : ?>
                <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Invitado">
                <div id="dropdownMenu" style="display: none;">
                    <h1>INVITADO</h1>
                    <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <button class="button-login"><a href="../login.php" class="navbar-login">LOGIN</a></button>
        <?php endif; ?>
    </div>
</header>
