//FUNCION:
//Script para ocultar el elemento cuando la resolución es mayor que 650px

function ocultarElemento() {
    var elementoOculto = document.getElementById("elementoOculto");
    if (window.innerWidth > 650) {
        elementoOculto.style.display = "none";
    } else {
        elementoOculto.style.display = "none";
    }
}

// Ejecutar la función al cargar la página y al cambiar el tamaño de la ventana
window.onload = ocultarElemento;
window.onresize = ocultarElemento;