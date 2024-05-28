<?php
// Ruta al archivo XML
$xmlFile = "../xm_xs/temporada.xml";

// Cargar el archivo XML
$xmlString = file_get_contents($xmlFile);
$xml = simplexml_load_string($xmlString);

if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    // Variable para el mensaje de éxito
    $successMessage = '';

    // Verificar si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_FILES['imagen'])) {
        // Obtén los valores de los campos del formulario
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $imagen = $_FILES['imagen']['name'];

        // Crea un nuevo elemento de noticia dentro de la sección de noticias
        $newNoticia = $xml->seccion->addChild('noticia');
        $newNoticia->addChild('id', 'noticia_' . (count($xml->seccion->noticia) + 1));
        $newNoticia->addChild('titulo', $titulo);
        $newNoticia->addChild('contenido', $contenido);
        $newNoticia->addChild('imagen')->addAttribute('src', '../imagenes/otras/noticias/' . $imagen);

        // Guarda el documento XML
        $xml->asXML($xmlFile);

        // Mueve el archivo de imagen subido a la carpeta de imágenes
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../imagenes/otras/noticias/" . $imagen);

        // Mensaje de éxito
        // $successMessage = 'La noticia se ha añadido correctamente.';

        // Redirigir al usuario después de procesar el formulario
        header("Location: noticias.php");
        exit;
    }
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
</head>
<body>
<?php include '../php/header.php'; ?>

<?php if ($loggedIn && $esAdmin): ?>
    <div class="button-add-news-centrar">
        <!-- Botón para abrir el formulario modal -->
        <button class="button-add-news" id="openModal">Añadir Noticia</button>
    </div>

    <!-- Modal y formulario -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Formulario para agregar una nueva noticia -->
            <form action="" method="post" enctype="multipart/form-data">
                <label for="titulo">Título Noticia:</label><br>
                <input type="text" id="titulo" name="titulo" required><br>
                <label for="contenido">Contenido Noticia:</label><br>
                <textarea id="contenido" name="contenido" required></textarea><br>
                <label for="imagen">Imagen:</label><br>
                <input type="file" id="imagen" name="imagen" required><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <!-- Script para abrir y cerrar el modal -->
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
<?php endif; ?>
<section class="noticias">
    <div class="grid-noticias">
        <?php 
        $contador = 0;
        echo '<div class="grid-fila">';
        if ($xml->seccion->noticia) {
            foreach ($xml->seccion->noticia as $noticia): 
                if ($contador % 3 == 0 && $contador != 0):
                    echo '</div><div class="clearfix"></div><div class="grid-fila">';
                endif; ?>
                <a href="<?php echo isset($noticia->imagen['href']) ? $noticia->imagen['href'] : '#'; ?>">
                    <div class="grid-noticia">
                        <img src="<?php echo $noticia->imagen['src']; ?>" alt="">
                        <div class="pie"><?php echo htmlspecialchars($noticia->titulo); ?></div>
                    </div>
                </a>
                <?php 
                $contador++;
            endforeach; 
        }
        if ($contador % 3 != 0):
            echo '</div><div class="clearfix"></div>';
        endif; ?>
    </div>
</section>

<?php if (!empty($successMessage)): ?>
    <div class="success-message"><?php echo $successMessage; ?></div>
<?php endif; ?>

<footer class="footer" id="footer"></footer>
<script src="../scripts/footer.js"></script>
<script src="../scripts/usuarios.js"></script>
</body>
</html>
