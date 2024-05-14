<?php
// Variable para el mensaje de éxito
$successMessage = '';
// Ruta al archivo XML y XSL
$xmlFile = '../xm_xs/temporada.xml';
$xslFile = '../xm_xs/clasi.xsl';

// Cargar el archivo XML
$xml = new DOMDocument();
$xml->load($xmlFile);

// Cargar la hoja de estilo XSL
$xsl = new DOMDocument();
$xsl->load($xslFile);

// Procesar la transformación
$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);
$xmlOutput = $proc->transformToXML($xml);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOF-Clasificacion</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
</head>

<body>
    <?php include '../php/header.php'; ?>
    <article>
        <!-- Contenido XML -->
        <div id="contenidoXML">
            <?php echo $xmlOutput; ?>
        </div>
    </article>
    <!-- Botón para subir arriba de la Pag -->
    <a class="boton" href="#active"><button class="pasubir">
            <svg class="svgIcon" viewBox="0 0 384 512">
                <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
            </svg>
        </button></a>
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
    <script src="../scripts/clasificacion.js"></script>
</body>

</html>
