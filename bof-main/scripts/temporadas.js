function irAPaginaSeleccionada() {
    // Obtener el valor seleccionado en el select
    var seleccion = document.getElementById("seleccionarPagina").value;
    
    // Cambiar a la página seleccionada
    window.location.href = seleccion;
}