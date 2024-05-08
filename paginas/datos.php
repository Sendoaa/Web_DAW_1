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
        </div>
    </header>
    <article>
        <!-- Contenido XML -->
        <div id="contenidoXML"></div>
    </article>
    <footer class="footer" id="footer"></footer>
    <script src="../scripts/footer.js"></script>
    <script>
        // Función para cargar y aplicar la transformación XSLT
        function loadXMLDoc(filename, callback) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    callback(this.responseXML);
                }
            };
            xhttp.open("GET", filename, true);
            xhttp.send();
        }

        // Cargar el archivo XML
        loadXMLDoc("../xm_xs/2023.xml", function(xml) { // Reemplaza "puerto" con el puerto de tu servidor local
            // Cargar el archivo XSL
            loadXMLDoc("../xm_xs/datos.xsl", function(xsl) { // Reemplaza "puerto" con el puerto de tu servidor local
                // Aplicar la transformación XSLT al XML
                var xsltProcessor = new XSLTProcessor();
                xsltProcessor.importStylesheet(xsl);
                var resultDocument = xsltProcessor.transformToFragment(xml, document);
                document.getElementById("contenidoXML").appendChild(resultDocument);
            });
        });
    </script>
</body>

</html>
