<!DOCTYPE html>
<html lang="es">
  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOF-Contacto</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
</head>
<!-- Contenido de la pagina -->
<body>
  <!-- Barra de navegacion -->
   <!--Cabecera de la página Barra Navegación mas Logo-->
   <?php include '../php/header.php'; ?>
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
  <script src="../scripts/usuarios.js"></script>
  </body>
</html>