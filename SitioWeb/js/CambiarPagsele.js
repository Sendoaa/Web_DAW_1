//FUNCION:
//Script para añadir la clase pagsele en la barra de navegación (marca la pagina en la que te encuetras)

$(document).ready(function () {
    // Obtener el título de la página actual
    var tituloPagina = $("title").text().trim();

    // Recorrer los enlaces y agregar la clase "pagsele" al que coincida con el título de la página
    $("#menu a").each(function () {
        if ($(this).attr("id") === tituloPagina) {
            $(this).addClass("pagsele");
        }
    });
});

