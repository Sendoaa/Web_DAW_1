<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Plantilla principal -->
  <xsl:template match="/">
    <html lang="es">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BOF-Equipos</title>
        <link rel="stylesheet" href="../estilos/styles.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
        <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png" />
        
        <script>
          function mostrarJornadas(temporada) {
            console.log("Temporada seleccionada:", temporada);
            var jornadas = document.querySelectorAll('.divpartidos');
            jornadas.forEach(function(jornada) {
              if (jornada.id === 'temporada' + temporada) {
                jornada.style.display = 'block';
              } else {
                jornada.style.display = 'none';
              }
            });
          }
        
          // Cargar la temporada 2023 por defecto al cargar la página
          window.onload = function() {
            document.getElementById('temporada').value = '2023';
            mostrarJornadas('2023');
          }
        </script>
      </head>
      <body>
        <!-- Selector de temporada -->
        <select id="temporada" onchange="mostrarJornadas(this.value)">
          <xsl:for-each select="//temporada">
            <option value="{numero}">
              <xsl:value-of select="concat('TEMPORADA ', numero)" />
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
    <xsl:apply-templates select="jornada" mode="temporada">
      <xsl:with-param name="seasonNumber" select="$currentSeason"/>
    </xsl:apply-templates>
  </xsl:template>

  <!-- Plantilla para procesar las jornadas de cada temporada -->
  <xsl:template match="jornada" mode="temporada">
    <xsl:param name="seasonNumber"/>
    <div class="divpartidos" id="{concat('temporada', $seasonNumber)}" style="display: none;">
      <h1 class="titulin">Jornada <xsl:value-of select="@num"/></h1>
      <xsl:apply-templates select="partido"/>
    </div>
  </xsl:template>

  <!-- Plantilla para procesar los partidos -->
  <xsl:template match="partido">
    <div class="infopartido">
      <label class="space">
        <h2><xsl:value-of select="fecha"/></h2>
        <h3><xsl:value-of select="hora"/></h3>
      </label>
      <hr/>
      <label class="space">
        <h3><xsl:value-of select="equipos/local"/></h3>
        <h3><xsl:value-of select="equipos/puntoslocal"/></h3>
        -
        <h3><xsl:value-of select="equipos/puntosvisitante"/></h3>
        <h3><xsl:value-of select="equipos/visitante"/></h3>
      </label>
      <hr/>
    </div>
  </xsl:template>

</xsl:stylesheet>
