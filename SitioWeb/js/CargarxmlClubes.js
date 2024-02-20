$(document).ready(function () {
    // Cargar otras secciones del sitio
    $("#navbarContainer").load("../html/navbar.html");
    $("#footerContainer").load("../html/footer.html");
    $("#formContainer").load("../html/formulario.html");
    $("#infclubContainer").load("../html/PaginaClub.html");

    // Inicializar el número de temporada actual
    var temporadaActual = 1;

    // Llamada a la función para cargar y transformar el XML con la temporada por defecto (temporada1)
    cargarTabla("temporada" + temporadaActual);
    cargarPaginaClub("PaginaClub_KiwisBC"); // Cargar la página del club específica al inicio


    // Agrega un evento clic al botón de descarga
    $("#descargarBtn").on("click", function () {
        // Llamada a la función para descargar el XML
        descargarXML();
    });

    $(document).on("click", "#derecha", function () {
        temporadaActual++;
        var archivoXML = `../xml/XML_temporada${temporadaActual}/clubes.xml`;

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

    // Agregar evento clic a los enlaces generados dinámicamente
    $("#tablaContainer").on("click", ".enlaces", function () {
        var idClub = $(this).attr("id");
        cargarPaginaClub(idClub);
        $("#fondoclub").css("display", "block");
    });
});

function cargarTabla(temporada) {
    // Cargar archivo XML 
    $.ajax({
        type: "GET",
        url: `../xml/XML_${temporada}/clubes.xml`,
        dataType: "xml",
        success: function (xml) {
            // Cargar la hoja de estilo XSLT
            $.ajax({
                type: "GET",
                url: "../xml/xsl/clubes.xsl",
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

function cargarPaginaClub(idClub) {
    // Cargar archivo XML 
    $.ajax({
        type: "GET",
        url: `../xml/XML_temporada1/clubes/PaginaClub_${idClub}.xml`, // Utilizar el id del club
        dataType: "xml",
        success: function (xml) {
            // Cargar la hoja de estilo XSLT
            $.ajax({
                type: "GET",
                url: "../xml/xsl/Paginaclub.xsl",
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
                    $("#PagClubContainer").html(resultHtml);
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

    var archivoXML = `../xml/XML_${temporadaActual}/clubes.xml`;

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
                    a.download = `clubes_${temporadaActual}.xml`;

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
