<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Plantilla principal -->
  <xsl:template match="/">
    <html lang="es">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>NSLA-Equipos</title>
        <link rel="stylesheet" href="../estilos/styles.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
        <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png" />
        
        <script>
          function mostrarEquipos(temporada) {
            console.log("Temporada seleccionada:", temporada);
            var equipos = document.querySelectorAll('.divequipos');
            equipos.forEach(function(equipo) {
              if (equipo.id === 'temporada' + temporada) {
                equipo.style.display = 'block';
              } else {
                equipo.style.display = 'none';
              }
            });
          }
        
          // Cargar la temporada 3 por defecto al cargar la página
          window.onload = function() {
            document.getElementById('temporada').value = '3';
            mostrarEquipos('3');
          }
        </script>
      </head>
      <body>
        <!-- Selector de temporada -->
        <select id="temporada" onchange="mostrarEquipos(this.value)">
          <xsl:for-each select="//temporada">
            <option value="{numero}">
              <xsl:value-of select="concat('Temporada ', numero)" />
            </option>
          </xsl:for-each>
        </select>

        <!-- Aplicamos las plantillas para todas las temporadas -->
        <xsl:apply-templates select="//temporada" />

        <a class="boton" href="#active">
          <button class="pasubir">
            <svg class="svgIcon" viewBox="0 0 384 512">
            </svg>
          </button>
        </a>
      </body>
    </html>
  </xsl:template>

<!-- Plantilla para procesar cada temporada -->
<xsl:template match="temporada">
  <xsl:variable name="currentSeason" select="numero" />
  <xsl:apply-templates select="equiposliga" mode="temporada">
    <xsl:with-param name="seasonNumber" select="$currentSeason"/>
  </xsl:apply-templates>
</xsl:template>

  <!-- Plantilla para procesar los equipos de cada temporada -->
  <xsl:template match="equiposliga" mode="temporada">
    <xsl:param name="seasonNumber"/>
    <xsl:for-each select="equipo">
      <section>
        <!-- Se asigna el ID 'temporada' + el número de temporada -->
        <div class="divequipos" id="{concat('temporada', $seasonNumber)}" style="display: none;">

          <details id="{nombreequipo/nombre}">
            <summary class="toggle-summary">
              <p><xsl:value-of select="nombreequipo/nombre" /></p>
              <span class="toggle-button">▶</span>
            </summary>
            <h1>Escudo:</h1>
            <div class="divjugadores">
              <div>
                <img class="escudo" src="{escudo}" alt="{escudo}" />
              </div>
            </div>
            <h1>Entrenador:</h1>
            <div class="divjugadores">
              <div>
                <img class="fotoequipos" src="{entrenador/imagen}" alt="{entrenador/nombre}" />
                <p><xsl:value-of select="entrenador/nombre" /></p>
              </div>
            </div>
            <hr />
            <h1>Jugadores:</h1>
            <!-- Procesar y mostrar los jugadores -->
            <xsl:apply-templates select="jugadores/*" />
          </details>
        </div>
      </section>
    </xsl:for-each>
  </xsl:template>

  <!-- Plantilla para procesar los jugadores de cada posición -->
  <xsl:template match="jugadores/*">
    <h4><u><xsl:value-of select="name()" /></u></h4>
    <div class="divjugadores">
      <xsl:for-each select="./*">
        <div class="jugador">
          <img class="fotoequipos" src="{imagen}" alt="{nombre}" />
          <p><xsl:value-of select="nombre" /></p>
        </div>
      </xsl:for-each>
    </div>
  </xsl:template>

</xsl:stylesheet>
