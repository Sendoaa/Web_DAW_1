<?php
// Variable para el mensaje de éxito
$successMessage = '';

// Ruta al archivo XML y XSL
$xmlFile = '../xm_xs/temporada.xml';
$xslFile = '../xm_xs/clasi.xsl';

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

// Obtener la temporada actual (puedes modificar esto según la lógica de tu aplicación)
$temporadaActual = '2023';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOF-Clasificacion</title>
  <link rel="stylesheet" href="../estilos/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="icon" type="image/x-icon" href="../imagenes/logos/BOFlogo.png">
</head>

<body>
  <?php include '../php/header.php'; ?>
  <article>
    <div id="contenidoXML">
      <?php echo $xmlOutput; ?>
    </div>
  </article>

  <a class="boton" href="#active"><button class="pasubir">
    <svg class="svgIcon" viewBox="0 0 384 512">
      <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
    </svg>
  </button></a>

  <footer class="footer">
    <div>
      <ul>
        <li><img src="../imagenes/logos/BOFlogo.png" alt="" class="logopie"></li>
        <li>
          <p>© 2023 NSLA Enterprises LLC. NSLA and the NSLA shield design are registered trademarks of the National Football League. The team names, logos and uniform designs are registered trademarks of the teams indicated. All other NSLA-related trademarks are trademarks of the National Football League. NSLA footage © NSLA Productions LLC.</p>
        </li>
        <li class="terms">
          <a href="./paginas/privacidad.html">Política de Privacidad</a>
          <a href="./paginas/terminos.html">Términos de Servicio</a>
          <a href="">Términos y Condiciones de Subscripción</a>
          <a href="">Tus Ajustes de Privacidad</a>
          <a href="">Ajustes de Cookies</a>
        </li>
      </ul>
    </div>
  </footer>
<script>
// Pasar la variable de temporada desde PHP a JavaScript
let temporadaActual = "<?php echo $temporadaActual; ?>";

function ordenarTablaPorPuntosTotales(ascendente = false) {
    // Obtener el cuerpo de la tabla de la temporada actual
    const tablaBody = document.getElementById('tablaBody' + temporadaActual);

    // Obtener las filas de la tabla y extraer los datos
    const filas = tablaBody.querySelectorAll('tr.divequipos');
    const datosFilas = Array.from(filas).map(fila => {
        const logoEquipo = fila.querySelector('td:nth-child(1) img').src;
        const nombreEquipo = fila.querySelector('td:nth-child(2)').textContent;
        const partidosJugados = fila.querySelector('td:nth-child(3)').textContent;
        const victorias = fila.querySelector('td:nth-child(4)').textContent;
        const derrotas = fila.querySelector('td:nth-child(5)').textContent;
        const puntosTotales = parseInt(fila.querySelector('td:nth-child(6)').textContent);
        return { logoEquipo, nombreEquipo, partidosJugados, victorias, derrotas, puntosTotales };
    });

    // Ordenar los datos
    datosFilas.sort((a, b) => {
        if (ascendente) {
            return a.puntosTotales - b.puntosTotales;
        } else {
            return b.puntosTotales - a.puntosTotales;
        }
    });

    // Limpiar el cuerpo de la tabla
    tablaBody.innerHTML = '';

    // Recrear el cuerpo de la tabla con los datos ordenados
    datosFilas.forEach(({ logoEquipo, nombreEquipo, partidosJugados, victorias, derrotas, puntosTotales }) => {
        const fila = document.createElement('tr');
        fila.classList.add('divequipos');
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

function mostrarClasificacion(temporada) {
    console.log("Temporada seleccionada:", temporada);
    var clasificaciones = document.querySelectorAll('.divtabla');
    clasificaciones.forEach(function(clasificacion) {
        if (clasificacion.id === 'temporada' + temporada) {
            clasificacion.style.display = 'block';
        } else {
            clasificacion.style.display = 'none';
        }
    });

    // Actualizar el valor del selector de temporada
    document.getElementById('temporadaTitulo').innerText = 'Temporada ' + temporada;

    // Actualizar la temporada actual
    temporadaActual = temporada;

    // Llamar a la función de ordenamiento para la nueva temporada
    ordenarTablaPorPuntosTotales();
}

document.addEventListener('DOMContentLoaded', () => {
    mostrarClasificacion(temporadaActual);
});

document.getElementById('botonOrdenar').addEventListener('click', () => {
    const ascendente = true; // Cambiar a false para orden descendente
    ordenarTablaPorPuntosTotales(ascendente);
});

</script>
<script src="../scripts/usuarios.js"></script>
</body>
</html>
