$(document).ready(function () {
    // Cargar otras secciones del sitio
    $("#navbarContainer").load("../html/navbar.html");
    $("#footerContainer").load("../html/footer.html");
    $("#formContainer").load("../html/formulario.html");

    // Inicializar el número de temporada actual
    var temporadaActual = 1;

    // Llamada a la función para cargar y transformar el XML con la temporada por defecto (temporada1)
    cargarTabla("temporada" + temporadaActual);

    // Agrega un evento clic al botón de descarga
    $("#descargarBtn").on("click", function () {
        // Llamada a la función para descargar el XML
        descargarXML();
    });

    $(document).on("click", "#derecha", function () {
        temporadaActual++;
        var archivoXML = `../xml/XML_temporada${temporadaActual}/clasificacion.xml`;
    
        // Verificar si el archivo XML existe
        $.ajax({
            type: "HEAD",
            url: archivoXML,
            success: function () {
                // El archivo XML existe, cargar la tabla
                cargarTabla("temporada" + temporadaActual);
            },
            error: function () {
                // El archivo XML no existe, volver a cargar el archivo por defecto
                temporadaActual = 1;
                cargarTabla("temporada1");
            }
        });
    });

    // Evento clic para el enlace de izquierda
    $(document).on("click", "#izquierda", function () {
        if (temporadaActual > 1) {
            temporadaActual--;
            cargarTabla("temporada" + temporadaActual);
        }
    });
});

function cargarTabla(temporada) {
    // Cargar archivo XML 
    $.ajax({
        type: "GET",
        url: `../xml/XML_${temporada}/calendario.xml`,
        dataType: "xml",
        success: function (xml) {
            // Cargar la hoja de estilo XSLT
            $.ajax({
                type: "GET",
                url: "../xml/xsl/calendario.xsl",
                dataType: "xml",
                success: function (xsl) {
                    // Crear un objeto de transformación XSLT
                    var xsltProcessor = new XSLTProcessor();
                    xsltProcessor.importStylesheet(xsl);

                    // Transformar el XML usando la hoja de estilo XSLT
                    var resultDocument = xsltProcessor.transformToDocument(xml);

                    // Obtener el contenido HTML resultante
                    var resultHtml = new XMLSerializer().serializeToString(resultDocument);

                    // Mostrar el resultado en el contenedor de la tabla
                    $("#tablaContainer").html(resultHtml);

                    // Establecer la temporada actual en el contenedor de la tabla
                    $("#tablaContainer").data("temporada", temporada);

                    // Actualizar el texto del elemento <li> con id "Temp"
                    $("#Temp").text("Temporada " + temporada.substr(-1));
                }
            });
        }
    });
}

function descargarXML() {
    // Obtener la temporada actual desde el contenedor de la tabla
    var temporadaActual = $("#tablaContainer").data("temporada");

    // Verificar si la temporada actual está definida
    if (!temporadaActual) {
        console.error("Error: No se puede determinar la temporada actual.");
        return;
    }

    var archivoXML = `../xml/XML_${temporadaActual}/calendario.xml`;

    // Verificar si el archivo XML existe
    $.ajax({
        type: "HEAD",
        url: archivoXML,
        success: function () {
            // El archivo XML existe, descargarlo
            $.ajax({
                type: "GET",
                url: archivoXML,
                dataType: "xml",
                success: function (xml) {
                    // Crear un objeto Blob con el contenido XML
                    var blob = new Blob([new XMLSerializer().serializeToString(xml)], { type: "text/xml" });

                    // Crear un objeto URL para el Blob
                    var url = window.URL.createObjectURL(blob);

                    // Crear un enlace invisible para descargar el archivo
                    var a = document.createElement("a");
                    a.href = url;
                    a.download = `calendario_${temporadaActual}.xml`;

                    // Agregar el enlace al documento y simular un clic
                    document.body.appendChild(a);
                    a.click();

                    // Remover el enlace y liberar el objeto URL
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                }
            });
        },
        error: function () {
            // El archivo XML no existe, mostrar un mensaje de error o manejar según sea necesario
            console.error("Error: El archivo XML no existe");
        }
    });
}
