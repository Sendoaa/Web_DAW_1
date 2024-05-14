// Función para ejecutar cuando el documento HTML se ha cargado completamente
document.addEventListener("DOMContentLoaded", function() {
  // Obtener el número de la temporada
  var numeroTemporada = obtenerNumeroTemporada(); // Define esta función según la lógica de tu aplicación

  // Llamar a la función para ordenar la tabla
  ordenarPorPuntos(numeroTemporada);
});

// Función para obtener el número de la temporada
function obtenerNumeroTemporada() {
  // Aquí puedes implementar la lógica para obtener el número de temporada según tus necesidades
  // Por ejemplo, puedes obtenerlo del archivo XML o de otro lugar en tu aplicación
  // Por simplicidad, en este ejemplo se asume que el número de temporada está disponible en una variable
  return 2023; // Reemplaza esto con la lógica real para obtener el número de temporada
}

// Función para ordenar la tabla por puntos totales
function ordenarPorPuntos(numero) {
  // El código JavaScript para ordenar la tabla según los puntos totales
  // Debes agregar aquí la lógica de tu función `ordenarPorPuntos`
  // Asegúrate de que esta función tenga acceso a la tabla generada por la transformación XSL
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById('tablaclasi' + numero);
  switching = true;
  /* Hacer un bucle hasta que no se realicen cambios */
  while (switching) {
      switching = false;
      rows = table.rows;
      /* Empezar en la segunda fila */
      for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          /* Obtener el valor de las dos celdas a comparar */
          x = parseInt(rows[i].getElementsByTagName('TD')[5].textContent);
          y = parseInt(rows[i + 1].getElementsByTagName('TD')[5].textContent);
          /* Comprobar si las dos filas deben intercambiarse */
          if (x < y) {
              /* Si se cumple la condición, marcar como un cambio y salir del bucle */
              shouldSwitch = true;
              break;
          }
      }
      if (shouldSwitch) {
          /* Realizar el intercambio y marcar que se ha realizado un cambio */
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
      }
  }
}
