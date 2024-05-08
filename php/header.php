<header>
        <div class="left-section">
            <a href="./index.html"><img src="../imagenes/logos/BOFlogo.png" alt=""></a>
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
            <a href="../index.php">Inicio</a>
            <a id="active" href="../paginas/calendario.php">Calendario</a>
            <a href="../paginas/clasi.php">Clasificación</a>
            <a href="../xm_xs/datos.php">Equipos</a>
            <a href="../paginas/noticias.php">Noticias</a>
            <a href="../paginas/contacto.php">Contacto</a>
            <?php if ($loggedIn) : ?>
                <?php if ($esAdmin) : ?>
                    <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Administrador">
                    <div id="dropdownMenu" style="display: none;">
                        <h1>ADMIN</h1>
                        <a href="../paginas/admin.php">Mi cuenta</a>
                        <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
                    </div>
                <?php elseif ($esInvitado) : ?>
                    <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Invitado">
                    <div id="dropdownMenu" style="display: none;">
                        <h1>INVITADO</h1>
                        <a href="/mi-cuenta">Mi cuenta</a>
                        <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <button class="button-login"><a href="./login.html" class="navbar-login">LOGIN</a></button>
            <?php endif; ?>
        </div>
    </header>