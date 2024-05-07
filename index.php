<?php
session_start();

// Definir $esAdmin y $esInvitado inicialmente como falsos
$esAdmin = false;
$esInvitado = false;

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


// Variable para el mensaje de éxito
$successMessage = '';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_FILES['imagen'])) {
  // Obtén los valores de los campos del formulario
  $titulo = $_POST['titulo'];
  $contenido = $_POST['contenido'];
  $imagen = $_FILES['imagen']['name'];

  // Crea un nuevo elemento de noticia
  $newNoticia = $xml->addChild('noticia');
  $newNoticia->addChild('id', 'noticia_' . (count($xml->noticia) + 1));
  $newNoticia->addChild('titulo', $titulo);
  $newNoticia->addChild('contenido', $contenido);
  $newNoticia->addChild('imagen')->addAttribute('src', '../imagenes/otras/noticias/' . $imagen);

  // Guarda el documento XML
  $xml->asXML($xmlFile);

  // Mueve el archivo de imagen subido a la carpeta de imágenes
  move_uploaded_file($_FILES['imagen']['tmp_name'], "../imagenes/otras/noticias/" . $imagen);

  // Mensaje de éxito
  $successMessage = 'La noticia se ha añadido correctamente.';

  // Redireccionar para evitar reenvío del formulario al actualizar la página
  header("Location: {$_SERVER['REQUEST_URI']}");
  exit();
}
?>
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
    <!-- Logo de la página -->
    <div class="left-section">
      <a href="./index.html"><img src="./imagenes/logos/BOFlogo.png" alt=""></a>
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
      <a id="active" href="../bof-main/index.php">Inicio</a>
      <a href="../bof-main/paginas/calendario.php">Calendario</a>
      <a href="../bof-main/paginas/clasi.php">Clasificación</a>
      <a href="../bof-main/paginas/datos.php">Equipos</a>
      <a href="../bof-main/paginas/noticias.php">Noticias</a>
      <a href="../bof-main/paginas/contacto.php">Contacto</a>
      <?php if ($loggedIn) : ?>
        <?php if ($esAdmin) : ?>
          <img id="userImage" src="./imagenes/otras/usuario.png" alt="Usuario Administrador">
          <div id="dropdownMenu" style="display: none;">
            <h1>ADMIN</h1>
            <a href="../paginas/admin.php">Mi cuenta</a>
            <a id="logoutlink" href="../bof-main/index.php?logout=true">Cerrar sesión</a>
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
        <button class="button-login"><a href="../bof-main/paginas/login.html" class="navbar-login">LOGIN</a></button>
      <?php endif; ?>
    </div>
    </div>
  </header>
  <!-- Articulos de noticias principales -->
  <article>
    <!-- Articulos de noticias principales -->
    <article>
      <!-- Divs para las dos Noticias -->
      <div class="noticiasinicio">
        <a class="textdecoration" href="./paginas/noticia1.html">
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
        <a class="textdecoration" href="./paginas/noticia2.html">
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
              <p>Cardinals</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Cowboys</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/Cardinals.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Cowboys.png" alt="">
            </div>
          </div>
          <!-- Primer proximo partido -->
          <div class="proxpar raiste">
            <div class="fechahora">
              <div>Sab,14,2023ㅤㅤㅤㅤㅤ 19:00</div>
            </div>
            <div class="equipos">
              <p>Raiders</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Steelers</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/Raiders.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Steelers.png" alt="">
            </div>
          </div>
          <!-- Segundo proximo partido -->
          <div class="proxpar benram">
            <div class="fechahora">
              <div>Dom,15,2023ㅤㅤㅤㅤㅤ 17:00</div>
            </div>
            <div class="equipos">
              <p>Bengals</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Rams</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/Bengals.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Rams.png" alt="">
            </div>
          </div>
          <!-- tercer proximo partido -->
          <div class="proxpar cowcar">
            <div class="fechahora">
              <div>Vie,20,2023ㅤㅤㅤㅤㅤ 19:00</div>
            </div>
            <div class="equipos">
              <p>Cowboys</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Cardinals</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/Cowboys.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Cardinals.png" alt="">
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
              <img class=logito src="./imagenes/otras/logosequipos/Steelers.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Raiders.png" alt="">
            </div>
          </div>
          <div class="proxpar ramben">
            <div class="fechahora">
              <div>Dom,22,2023ㅤㅤㅤㅤㅤ 21:00</div>
            </div>
            <div class="equipos">
              <p>Rams</p>
              <img src="./imagenes/otras/vs.png" alt="">
              <p>Bengals</p>
            </div>
            <div class="equipos">
              <img class=logito src="./imagenes/otras/logosequipos/Rams.png" alt="">
              <a href="./xm_xs/calendar_t3.xml"><button class="vermas">Ver más</button></a>
              <img class=logito src="./imagenes/otras/logosequipos/Bengals.png" alt="">
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