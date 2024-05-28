
<?php
// CONTROL DEL LOGIN

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
    header("Location: ./index.php");
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
    header("Location: ./paginas/login.php");
    exit;
}
?>
<!-- Este es el indice de la pagina web -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOF</title>
  <link rel="stylesheet" href="./estilos/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="icon" type="image/x-icon" href="./imagenes/logos/BOFlogo.png">
</head>
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="fb2e60d4-77bc-40f3-abd5-a336f7e2f383" data-blockingmode="auto" type="text/javascript"></script>

<body>
  <!--Cabecera de la página Barra Navegación mas Logo-->
  <header>
    <div class="left-section">
        <a href="./index.php"><img src="./imagenes/logos/BOFlogo.png" alt=""></a>
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
        <a <?php echo ($currentPage == 'index.php') ? 'id="active"' : ''; ?> href="./index.php">Inicio</a>
        <a <?php echo ($currentPage == 'calendario.php') ? 'id="active"' : ''; ?> href="./paginas/calendario.php">Calendario</a>
        <a <?php echo ($currentPage == 'clasi.php') ? 'id="active"' : ''; ?> href="./paginas/clasi.php">Clasificación</a>
        <a <?php echo ($currentPage == 'datos.php') ? 'id="active"' : ''; ?> href="./paginas/datos.php">Equipos</a>
        <a <?php echo ($currentPage == 'noticias.php') ? 'id="active"' : ''; ?> href="./paginas/noticias.php">Noticias</a>
        <a <?php echo ($currentPage == 'contacto.php') ? 'id="active"' : ''; ?> href="./paginas/contacto.php">Contacto</a>
        <?php if ($loggedIn) : ?>
            <?php if ($esAdmin) : ?>
                <img id="userImage" src="./imagenes/otras/usuario.png" alt="Usuario Administrador">
                <div id="dropdownMenu" style="display: none;">
                    <h1>ADMIN</h1>
                    <a href="./paginas/admin.php">Mi cuenta</a>
                    <a id="logoutlink" href="index.php?logout=true">Cerrar sesión</a>
                </div>
            <?php elseif ($esInvitado) : ?>
                <img id="userImage" src="./imagenes/otras/usuario.png" alt="Usuario Invitado">
                <div id="dropdownMenu" style="display: none;">
                    <h1>INVITADO</h1>
                    <a id="logoutlink" href="index.php?logout=true">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <button class="button-login"><a href="./paginas/login.php" class="navbar-login">LOGIN</a></button>
        <?php endif; ?>
    </div>
</header>
  <!-- Articulos de noticias principales -->
    <article>
      <!-- Divs para las dos Noticias -->
      <div class="noticiasinicio">
        <a class="textdecoration">
          <!-- Primera Noticia -->
          <div class="columna espaciado">
            <div class="foto">
              <img class="fotonoti" src="./imagenes/otras/noticias/noticia1.jpg" alt="Foto de la noticia">
            </div>
            <div class="pie-fotonoti">
              <h1>Una bestia llamada Stephen curry</h1>
              <p>
                Stephen Curry lidera a los Warriors hacia otra victoria con su magistral juego de tiro y liderazgo en la cancha. Su habilidad para crear oportunidades y desequilibrar defensas sigue siendo insuperable, consolidándolo como uno de los mejores jugadores de la liga BOF.
              </p>
            </div>
          </div>
        </a>
        <a class="textdecoration">
          <!-- Segunda Noticia -->
          <div class="columna">
            <div class="foto">
              <img class="fotonoti" src="./imagenes/otras/noticias/noticia15.jpg" alt="Foto de la noticia">
            </div>
            <div class="pie-fotonoti">
              <h1>
                  El diamante en bruto Luka Doncic
              </h1>
              <p>
Luka Doncic impresiona con su actuación estelar liderando a los Mavericks hacia una importante victoria. Su destreza para controlar el juego y su habilidad para anotar y asistir lo destacan como uno de los jóvenes talentos más brillantes historicamente de BOF.</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Lista lateral de Proximos Partidos -->
      <div class="galeria">
        <div class="lista-proxpar">
          <!-- Primer proximo partido -->
          <div class="proxpar carcow">
            <div class="fechahora">
              <div>Vie,13,2023ㅤㅤㅤㅤㅤ 20:00</div>
            </div>
            <div class="equipos">
              <p>Warriors</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Rockets</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/warriors.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/rockets.png" alt="">
            </div>
          </div>
          <!-- Primer proximo partido -->
          <div class="proxpar raiste">
            <div class="fechahora">
              <div>Sab,14,2023ㅤㅤㅤㅤㅤ 19:00</div>
            </div>
            <div class="equipos">
              <p>Clippers</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Celtics</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/clippers.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/celtics.png" alt="">
            </div>
          </div>
          <!-- Segundo proximo partido -->
          <div class="proxpar benram">
            <div class="fechahora">
              <div>Dom,15,2023ㅤㅤㅤㅤㅤ 17:00</div>
            </div>
            <div class="equipos">
              <p>Lakers</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Rockets</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/lakers.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/rockets.png" alt="">
            </div>
          </div>
          <!-- tercer proximo partido -->
          <div class="proxpar cowcar">
            <div class="fechahora">
              <div>Vie,20,2023ㅤㅤㅤㅤㅤ 19:00</div>
            </div>
            <div class="equipos">
              <p>Celtics</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Mavericks</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/celtics.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/mavericks.png" alt="">
            </div>
          </div>
          <!-- Cuarto proximo partido -->
          <div class="proxpar sterai">
            <div class="fechahora">
              <div>Sab,21,2023ㅤㅤㅤㅤㅤ 21:00</div>
            </div>
            <div class="equipos">
              <p>Steelers</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Raiders</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/cavaliers.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/grizzlies.png" alt="">
            </div>
          </div>
          <div class="proxpar ramben">
            <div class="fechahora">
              <div>Dom,22,2023ㅤㅤㅤㅤㅤ 21:00</div>
            </div>
            <div class="equipos">
              <p>Mavericks</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Clippers</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/mavericks.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
                <img class=logito src="./imagenes/otras/logosequipos/clippers.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </article>
    <h1 class="lideres">Jugadores Líderes</h1>
    <!-- Sección de podio -->
    <section class="podium">
      <div class="podio">
        <!-- Mejor jugador, en podio de oro -->
        <div class="puesto primero">
          <div class="podiofoto">
            <img src="./imagenes/otras/luka.jpg" alt="Primer Lugar">
          </div>
          <p class="pie-foto">Luka Doncic - Dallas Mavericks</p>
          <p class="pie-foto2">33.9 pts promedios por partidos y un promedio de 4 triples anotados por partido.</p>
        </div>
        <!-- Segundo mejor jugador, en podio de plata -->
        <div class="puesto segundo">
          <div class="podiofoto">
            <img src="./imagenes/otras/stephen.webp" alt="Segundo Lugar">
          </div>
          <p class="pie-foto">Stephen curry - Golden State Warriors</p>
          <p class="pie-foto2">Stephen ha anotado la impresionante cantidad de 357 triples en tan solo una temporada. </p>
        </div>
        <!-- Tercer mejor jugador, en podio de bronce -->
        <div class="puesto tercero">
          <div class="podiofoto">
            <img src="./imagenes/otras/domantas.png" alt="Tercer Lugar">
          </div>
          <p class="pie-foto">Domantas Sabonis - Sacramento Kings</p>
          <p class="pie-foto2">La bestia defensiva ha llegado a conseguir 13.7 rebotes por partido..</p>
        </div>
      </div>
    </section>
    <!-- Botón para subir arriba de la Pag -->
    <a class="boton" href="#active"><button class="pasubir">
        <svg class="svgIcon" viewBox="0 0 384 512">
          <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
        </svg>
      </button></a>
    <script>
      // Obtener referencias a los elementos del DOM
      var modal = document.getElementById('myModal');
      var btnOpenModal = document.getElementById('openModal');
      var spanCloseModal = document.getElementsByClassName('close')[0];

      // Función para abrir el modal
      btnOpenModal.onclick = function() {
        modal.style.display = 'block';
      }

      // Función para cerrar el modal
      spanCloseModal.onclick = function() {
        modal.style.display = 'none';
      }

      // Cerrar el modal si el usuario hace clic fuera de él
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      }
    </script>
    <!-- Pie de pagina -->
    <footer class="footer">
      <div>
        <ul>
          <li><img src="./imagenes/logos/BOFlogo.png" alt="" class="logopie"></li>
          <li>
            <p>© 2023 NSLA Enterprises LLC. NSLA and the NSLA shield design are registered trademarks of the National Football League.The team names, logos and uniform designs are registered trademarks of the teams indicated. All other NSLA-related trademarks are trademarks of the National Football League. NSLA footage © NSLA Productions LLC.</p>
          </li>
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

    <script src="../bof-main/scripts/usuarios.js"></script>
</body>

</html>