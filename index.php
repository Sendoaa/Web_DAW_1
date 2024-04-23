<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    // Si no ha iniciado sesión, no hacer nada
    return;
  } else {
    $loggedIn = true;
  }


// El usuario ha iniciado sesión, continuar con el contenido de la página
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
    <link rel="icon" type="image/x-icon" href="./imagenes/logos/nofondo.png">
</head>
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="fb2e60d4-77bc-40f3-abd5-a336f7e2f383" data-blockingmode="auto" type="text/javascript"></script>
<body>
    <!--Cabecera de la página Barra Navegación mas Logo-->
    <header>
        <!-- Logo de la página -->
        <div class="left-section">
          <a href="./index.html"><img src="./imagenes/logos/nofondo2.png" alt=""></a>
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
          <a id="active" href="index.html">Inicio</a>
          <a href="./xm_xs/2023.xml">Calendario</a>
          <a href="./paginas/clasi.html">Clasificación</a>
          <a href="./xm_xs/datos.xml">Equipos</a>
          <a href="./paginas/noticias.html">Noticias</a>
          <a href="./paginas/contacto.html">Contacto</a>
          <button class="button-login"><a href="./paginas/login.html" class="navbar-login">LOGIN</a></button>
        </div>
    </header>
    <!-- Articulos de noticias principales -->
    <article>
      <!-- Divs para las dos Noticias -->
      <div class="noticiasinicio">
      <a class="textdecoration" href="./paginas/noticia1.html">
        <!-- Primera Noticia -->
        <div class="columna espaciado">
          <div class="foto">
            <img class="fotonoti" src="./imagenes/otras/new1.jpg" alt="Foto de la noticia">
          </div>
          <div class="pie-fotonoti">
            <h1>Un desastre llamado Zach Wilson</h1>
            <p>Incapacidad para leer defensas, incapacidad para progresar en sus lecturas e incapacidad para crear fuera de la estructura del ataque. La receta Zach Wilson está abocada al fracaso y los Jets deben cambiar el rumbo rápido si no quieren perder una defensiva de campeonato.</p>
          </div>
        </div>
      </a>
      <a class="textdecoration" href="./paginas/noticia2.html">
        <!-- Segunda Noticia -->
        <div class="columna">
          <div class="foto">
              <img class="fotonoti" src="./imagenes/otras/new2.jpg" alt="Foto de la noticia">
            </div>
            <div class="pie-fotonoti">
              <h1>Nuevas reglas para los playoffs</h1>
              <p>Las nuevas reglas de tiempo extra de los playoffs incluyen períodos de 15 minutos en lugar del período de tiempo extra de 10 minutos en la temporada regular. Si el equipo que recibió el balón primero no anota un touchdown sacara de nuevo el contrincante desde su área.</p>
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
                <img src="./imagenes/otras/murray.jpg" alt="Primer Lugar">
            </div>
            <p class="pie-foto">Kyler Murray - Arizona Cardinals</p>
            <p class="pie-foto2">Tan solo disputó 4 partidos como rookie y consiguió 708 yardas y 2 touchdowns.</p>
        </div>
        <!-- Segundo mejor jugador, en podio de plata -->
        <div class="puesto segundo">
            <div class="podiofoto">
                <img src="./imagenes/otras/adams.jpg" alt="Segundo Lugar">
            </div>
            <p class="pie-foto">Davante Adams - Las Vegas Raiders</p>
            <p class="pie-foto2">7 touchdowns de pase y ninguna intercepción, consiguiendo completar 72% de sus intentos. </p>
        </div>
        <!-- Tercer mejor jugador, en podio de bronce -->
        <div class="puesto tercero">
            <div class="podiofoto">
                <img src="./imagenes/otras/elliot.jpg" alt="Tercer Lugar">
            </div>
            <p class="pie-foto">Ezekiel Elliott - Dallas Cowboys</p>
            <p class="pie-foto2">Permitió sumar 50 yardas por acarreo por partido y promedia de 4 touchdowns.</p>
        </div>
      </div>
    </section>
    <!-- Botón para subir arriba de la Pag -->
    <a class="boton" href="#active"><button class="pasubir">
      <svg class="svgIcon" viewBox="0 0 384 512">
        <path
          d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
        ></path>
      </svg>
    </button></a>
    <!-- Pie de pagina -->
    <footer class="footer">
      <div>
        <ul>
          <li><img src="./imagenes/logos/nofondo.png" alt="" class="logopie"></li>
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