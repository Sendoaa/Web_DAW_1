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
    <title>NSLA-Contacto</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
</head>
<!-- Contenido de la pagina -->
<body>
  <!-- Barra de navegacion -->
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
      <a href="../paginas/clasi.php">Clasificación</a>
      <a href="../paginas/datos.php">Equipos</a>
      <a href="../paginas/noticias.php">Noticias</a>
      <a  id="active" href="../paginas/contacto.php">Contacto</a>
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
        <button class="button-login"><a href="../paginas/login.html" class="navbar-login">LOGIN</a></button>
      <?php endif; ?>
    </div>
    </div>
  </header>
    <!-- Formulario de contacto -->
    <div class="formcontact">
      <section class="sectionpacontact">
          <!-- Tipos de Inputs (text,email) -->
          <form method="post" action="../paginas/guardar.php">
            <input type="text" name="nombre" class="entradatext" required placeholder="Nombre"/>
            <input type="text" name="apellidos" class="entradatext" required placeholder="Apellidos"/>
            <input type="email" name="correo" class="entradatext" required placeholder="Dirección de correo"/>
            <textarea name="mensaje" class="entradatext" required placeholder="Mensaje"></textarea>
            <input class="enviar" type="submit" name="submit" value="Enviar"/>
        </form>
      </section>
    </div>
     <!-- Pie de pagina -->
    <footer class="footer" id="footer"></footer>
    <script src="../scripts/footer.js"></script>
    
    <script>
      // JavaScript para mostrar el mensaje de confirmación si el formulario se ha enviado correctamente
      document.addEventListener('DOMContentLoaded', function() {
          const urlParams = new URLSearchParams(window.location.search);
          const enviado = urlParams.get('enviado');
          
          if (enviado === 'true') {
              if (confirm('¡Mensaje enviado correctamente, contactaremos contigo lo antes posible!')) {
                  window.location.href = 'contacto.html'; // Redirige a contacto.html cuando el usuario acepteS
              }
          }
      });
  </script>
  <script src="../bof-main/scripts/usuarios.js"></script>
  </body>
</html>