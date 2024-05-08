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
    <title>NSLA-Noticias</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
    <script src="../scripts/usuarios.js"></script>
</head>
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="fb2e60d4-77bc-40f3-abd5-a336f7e2f383" data-blockingmode="auto" type="text/javascript"></script>

<body>
  <!--Cabecera de la página Barra Navegación mas Logo-->
  <header>
    <!-- Logo de la página -->
    <div class="left-section">
      <a href="./index.html"><img src="../imagenes/logos/BOFlogo.png" alt=""></a>
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
      <a href="../index.php">Inicio</a>
      <a href="../paginas/calendario.php">Calendario</a>
      <a id="active" href="../paginas/clasi.php">Clasificación</a>
      <a href="../paginas/datos.php">Equipos</a>
      <a href="../paginas/noticias.php">Noticias</a>
      <a href="../paginas/contacto.php">Contacto</a>
      <?php if ($loggedIn) : ?>
        <?php if ($esAdmin) : ?>
          <img id="userImage" src="../imagenes/otras/usuario.png" alt="Usuario Administrador">
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

  <div class="select">
    <select id="seleccionarPagina">
      <option value="">Selecciona una Temporada</option>
    </select>
  </div>

  <section>
    <h1 id="tituloTemporada" class="titulin"></h1>
    <!-- Tabla de clasificación -->
    <div class="divtabla">
      <table id="tablaclasi" class="tablaclasi">
        <thead>
          <tr>
            <th colspan="9" class="titulotabla">Tabla de Clasificación de la NSLA</th>
          </tr>
          <tr class="columnatabla">
            <th title="Logo">Logo</th>
            <th title="Nombre">Nombre</th>
            <th title="Partidos Jugados">PJ</th>
            <th title="Victorias">V</th>
            <th title="Derrotas">D</th>
            <th title="Empates">E</th>
            <th title="Puntos Totales">PT</th>
          </tr>
        </thead>
        <tbody id="tablaBody">
          <!-- Aqui se carga lo de JS -->
        </tbody>
      </table>
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
          <li><img src="../imagenes/logos/BOFlogo.png" alt="" class="logopie"></li>
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
</body>

<script src="../scripts/clasificacion.js"></script>

</html>