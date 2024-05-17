// Pasar la variable de temporada desde PHP a JavaScript
const temporadaActual = "<?php echo $temporadaActual; ?>";

function ordenarTablaPorPuntosTotales(ascendente = false) { // Cambiado a false para orden descendente por defecto
        // Get the table body element
        const tablaBody = document.getElementById('tablaBody' + temporadaActual);

        // Get table rows and extract data
        const filas = tablaBody.querySelectorAll('tr.divequipos');
        const datosFilas = Array.from(filas).map(fila => {
                const logoEquipo = fila.querySelector('td:nth-child(1) img').src; // Assuming logo is in the 1st cell
                const nombreEquipo = fila.querySelector('td:nth-child(2)').textContent; // Assuming team name is in 2nd cell
                const partidosJugados = fila.querySelector('td:nth-child(3)').textContent; // Assuming matches played is in 3rd cell
                const victorias = fila.querySelector('td:nth-child(4)').textContent; // Assuming wins are in 4th cell
                const derrotas = fila.querySelector('td:nth-child(5)').textContent; // Assuming losses are in 5th cell
                const puntosTotales = parseInt(fila.querySelector('td:nth-child(6)').textContent); // Assuming points are in 6th cell
                return { logoEquipo, nombreEquipo, partidosJugados, victorias, derrotas, puntosTotales };
        });

        // Sort the data array
        datosFilas.sort((a, b) => {
                if (ascendente) {
                        return a.puntosTotales - b.puntosTotales;
                } else {
                        return b.puntosTotales - a.puntosTotales;
                }
        });

        // Clear the table body
        tablaBody.innerHTML = '';

        // Recreate table body with sorted data
        datosFilas.forEach(({ logoEquipo, nombreEquipo, partidosJugados, victorias, derrotas, puntosTotales }) => {
                const fila = document.createElement('tr');
                fila.classList.add('divequipos'); // Re-add the class for styling
                // Update cell content based on your actual table structure
                fila.innerHTML = `
                        <td><img src="${logoEquipo}" alt="${nombreEquipo}" style="width: 50px; height: auto;" /></td>
                        <td>${nombreEquipo}</td>
                        <td>${partidosJugados}</td>
                        <td>${victorias}</td>
                        <td>${derrotas}</td>
                        <td>${puntosTotales}</td>
                `;
                tablaBody.appendChild(fila);
        });
}

 // Call the function to sort the table on page load
 document.addEventListener('DOMContentLoaded', () => {
        setInterval(() => {
                ordenarTablaPorPuntosTotales();
        }, 500); // Sort the table every 0.005 seconds
});

// Llamar a la función para ordenar la tabla cuando sea necesario, por ejemplo, cuando se haga clic en un botón
document.getElementById('botonOrdenar').addEventListener('click', () => {
        // Obtener la temporada seleccionada
        const temporadaSeleccionada = document.getElementById('temporadaSeleccionada').value;
        // Determinar si se debe ordenar ascendente o descendente
        const ascendente = true; // Cambiar a false para orden descendente
        // Actualizar la variable de temporada actual
        temporadaActual = temporadaSeleccionada;
        // Llamar a la función de ordenamiento
        ordenarTablaPorPuntosTotales(ascendente);
});