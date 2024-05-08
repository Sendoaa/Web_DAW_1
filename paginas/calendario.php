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


    $xml = simplexml_load_file('../xm_xs/temporada.xml');

    // Guarda el documento XML
    $xml->asXML('../xm_xs/temporada.xml');




    
    // Redireccionar para evitar reenvío del formulario al actualizar la página
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// Cargar el contenido XML por defecto (calendario.xml) para mostrar el calendario inicialmente
$temporadaSeleccionada = isset($_GET['temporada']) ? $_GET['temporada'] : '2023';
$xml = simplexml_load_file("../xm_xs/temporada.xml");



// Filtrar los datos de la temporada seleccionada
$resultado = $xml->xpath("//temporada[@num='$temporadaSeleccionada']");





$temporada = $resultado[0];
// Crear un nuevo documento XML con los datos de la temporada seleccionada
$newXml = new SimpleXMLElement('<temporada></temporada>');
$newXml->addAttribute('num', $temporadaSeleccionada);
foreach ($temporada->children() as $child) {
    if ($child->getName() == 'jornada') {
        $newJornada = $newXml->addChild($child->getName());
        foreach ($child->attributes() as $attrKey => $attrValue) {
            $newJornada->addAttribute($attrKey, $attrValue);
        }
        foreach ($child->partido as $partido) {
            $newPartido = $newJornada->addChild('partido');
            $newPartido->addChild('fecha', $partido->fecha);
            $newPartido->addChild('hora', $partido->hora);
            $equipos = $newPartido->addChild('equipos');
            $equipos->addChild('local', $partido->equipos->local);
            $equipos->addChild('puntoslocal', $partido->equipos->puntoslocal);
            $equipos->addChild('visitante', $partido->equipos->visitante);
            $equipos->addChild('puntosvisitante', $partido->equipos->puntosvisitante);
        }
    } else {
        $newChild = $newXml->addChild($child->getName(), $child);
        foreach ($child->attributes() as $attrKey => $attrValue) {
            $newChild->addAttribute($attrKey, $attrValue);
        }
    }
}
// Cargar el archivo XSL
$xsl = new DOMDocument();
$xsl->load('../xm_xs/calendar.xsl');

// Crear el procesador XSLT
$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl); // Importar el estilo XSL

// Transformar el XML con el XSL
$xmlOutput = $proc->transformToXml($newXml);

// Si la solicitud es AJAX, devolver solo el contenido XML
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: text/xml');
    echo $xmlOutput;
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

<body>
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
    <article>
          <!-- Contenido XML -->
         <div id="contenidoXML">
            <?php echo $xmlOutput; ?>
        </div>
    </article>
    <footer class="footer" id="footer"></footer>
    <script src="../scripts/footer.js"></script>
</body>

</html>
