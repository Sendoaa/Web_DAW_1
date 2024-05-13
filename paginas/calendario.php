<?php
// Variable para el mensaje de éxito
$successMessage = '';
// Ruta al archivo XML y XSL
$xmlFile = '../xm_xs/temporada.xml';
$xslFile = '../xm_xs/calendar.xsl';

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
    <title>BOF-Calendario</title>
    <link rel="stylesheet" href="../estilos/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
    <script src="../scripts/usuarios.js"></script>
</head>

<body>
    <?php include '../php/header.php'; ?>
    <article>
        <!-- Contenido XML -->
        <div id="contenidoXML">
            <?php echo $xmlOutput; ?>
        </div>
    </article>
    <footer class="footer" id="footer"></footer>
    <script src="../scripts/footer.js"></script>
    <script src="../scripts/usuarios.js"></script>
</body>

</html>
