<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['nombre'])) {
    $loggedIn = true;
    $nombreUsuario = $_SESSION['nombre'];
    $esAdmin = ($_SESSION['nombre'] == 'admin');
    $esInvitado = ($_SESSION['nombre'] == 'invitado');
    if ($_SESSION['nombre'] == 'admin') {
      $esAdmin = true;
      $esInvitado = false;
    } else {
      $esAdmin = false;
      $esInvitado = true;
    }
    

} else {
    $loggedIn = false;
}

// Verificar si el usuario ha hecho clic en el enlace de cierre de sesión
if (isset($_GET['logout'])) {
  $loggedIn = false;
  unset($_SESSION['nombre']);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSLA-Noticias</title>
  <link rel="stylesheet" href="../estilos/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png">
  <script>src="../scripts/usuarios.js"</script>
</head>
<!-- Contenido de la pagina -->
<body>
 <!--Cabecera de la página Barra Navegación mas Logo-->
 <header>
        <!-- Logo de la página -->
        <div class="left-section">
          <a href="./index.html"><img src="../imagenes/logos/nofondo2.png" alt=""></a>
        </div>
        <!-- Hamburguesa de menu para abrir menu navegación -->
        <div class="togglearea">
            <label for="toggle">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
          <input type="checkbox" id="toggle"> 
        <!-- Barra navegación -->
        <div class="navbar">
          <a href="../index.html">Inicio</a>
          <a href="../xm_xs/2023.xml">Calendario</a>
          <a href="../paginas/clasi.html">Clasificación</a>
          <a href="../xm_xs/datos.xml">Equipos</a>
          <a id="active" href="../paginas/noticias.php">Noticias</a>
          <a href="../paginas/contacto.html">Contacto</a>
          <?php if ($loggedIn): ?>
    <?php if ($esAdmin): ?>
        <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Administrador">
        <div id="dropdownMenu" style="display: none;">
        <h1>ADMIN</h1>
        <a href="../paginas/admin.php">Mi cuenta</a>
        <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
        </div>
    <?php elseif ($esInvitado): ?>
        <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Invitado">
        <div id="dropdownMenu" style="display: none;">
        <h1>INVITADO</h1>
        <a href="/mi-cuenta">Mi cuenta</a>
        <a id="logoutlink" href="noticias.php?logout=true">Cerrar sesión</a>
        </div>
    <?php endif; ?>
<?php else: ?>
    <button class="button-login"><a href="./login.html" class="navbar-login">LOGIN</a></button>
<?php endif; ?>
</div>
    </header>
<!-- Seccion de todas las noticias -->
 <section class="noticias">
    <h1>Últimas Noticias</h1>
    <!-- Div de tres noticias -->
    <div class="grid-noticias">
      <a href="noticia1.html">
        <!-- Primera noticia Imagen + Pie -->
        <div class="grid-noticia">
          <img src="../imagenes/otras/noticias/noticia1.jpg" alt="">
          <div class="pie">Un desastre llamado Zach Wilson</div>
        </div>
      </a>
       <!-- Segunda noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia2.jpg" alt="">
        <div class="pie">Los Jets cambian al WR Mecole Hardman a los Chiefs</div>
      </div>
       <!-- Tercera noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia3.png" alt="">
        <div class="pie">Informe de lesiones de la NSLA de la semana 7 para la temporada 2023</div>
      </div>
    </div>
     <!-- Seccion Noticias Populares -->
    <h1>Noticias Populares</h1>
    <div class="grid-noticias">
      <a href="noticia2.html">
         <!-- Primera noticia Imagen + Pie -->
        <div class="grid-noticia">
          <img src="../imagenes/otras/noticias/noticia4.png" alt="">
          <div class="pie">Nuevas reglas para los playoffs <p></p>
          </div>
        </div>
      </a>
       <!-- Segunda noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia5.png" alt="">
        <div class="pie">Anthony Richardson se someterá a una cirugía de hombro que pondrá fin a su temporada</div>
      </div>
       <!-- Tercera noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia6.webp" alt="">
        <div class="pie">El comisionado de la NSLA, Roger Goodell, acuerda una extensión de contrato hasta 2027</div>
      </div>
    </div>
     <!-- Seccion Para ti -->
    <h1>Para ti</h1>
    <div class="grid-noticias">
       <!-- Primera noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia7.webp" alt="">
        <div class="pie"><p></p>La NSLA busca eliminar el tackle con caída de cadera y discute el 'empuje de trasero'</div>
      </div>
       <!-- Segunda noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/noticias/noticia8.png" alt="">
        <div class="pie"><p></p><p>Bears CB Jaylon Johnson 'no ciego' para negociar</p></div>
      </div>
       <!-- Tercera noticia Imagen + Pie -->
      <div class="grid-noticia">
        <img src="../imagenes/otras/radio2.jpg" alt="">
        <div class="pie">
          <!-- Audio en directo de una radio sobre la NFL -->
          <audio controls>
            <source src="https://playerservices.streamtheworld.com/api/livestream-redirect/KRLVAM.mp3"></source>
          </audio>
        </div>
      </div>
    </div>
  </section>

</body>
 <!-- Pie de pagina -->
<footer class="footer" id="footer"></footer>
<script src="../scripts/footer.js"></script>
<script src="../scripts/usuarios.js"></script>

</html>