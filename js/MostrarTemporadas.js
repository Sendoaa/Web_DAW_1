//FUNCION:
//Funcion para desplegar el selector de temporadas cuando la resolucion de la pantalla esta minimizada

// Obtener referencia al botón y al elemento oculto
var MostrarOcutarTemp = document.getElementById('MostrarOcutarTemp');
var TempOculta = document.getElementById('TempOculta');

// Agregar un evento de clic al botón
MostrarOcutarTemp.addEventListener('click', function () {
    // Alternar entre mostrar y ocultar el elemento
    if (TempOculta.style.display === 'none' || TempOculta.style.display === '') {
        TempOculta.style.display = 'block';
    } else {
        TempOculta.style.display = 'none';
    }
});

// Función para verificar la resolución y mostrar el elemento si es mayor que 850px
function verificarResolucion() {
    var anchoVentana = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (anchoVentana > 850) {
        TempOculta.style.display = 'block';
    } else {
        TempOculta.style.display = 'none';
    }
}

// Llamar a la función al cargar la página y en el evento de cambio de tamaño de la ventana
verificarResolucion();
window.addEventListener('resize', verificarResolucion);
