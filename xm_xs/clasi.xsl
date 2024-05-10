<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Plantilla principal -->
  <xsl:template match="/">
    <html lang="es">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Clasificación Temporada</title>
        <link rel="stylesheet" href="../estilos/styles.css" />
        <style>
          /* Estilos adicionales pueden ser agregados aquí */
        </style>
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
            document.getElementById('seleccionarPagina').value = '2023';
            mostrarEquipos('2023');
          }
          
        </script>
      </head>
      <body>
        <xsl:apply-templates select="temporada"/>
      </body>
    </html>
  </xsl:template>

  <!-- Plantilla para la clasificación -->
  <xsl:template match="temporada">
    <xsl:variable name="tituloTemporada" select="@nombre"/>
    <xsl:variable name="equipos" select="equipo"/>
    
    <div class="select">
      <select id="temporada" onchange="mostrarEquipos(this.value)">
        <option value="">Selecciona una Temporada</option>
        <xsl:for-each select="//temporada">
          <option value="{@numero}">
            <xsl:value-of select="@nombre" />
          </option>
        </xsl:for-each>
      </select>
    </div>
    
    <section>
      <h1 id="tituloTemporada" class="titulin">
        <xsl:value-of select="$tituloTemporada"/>
      </h1>
      <div class="divtabla">
        <table id="tablaclasi" class="tablaclasi">
          <thead>
            <tr>
              <th colspan="7" class="titulotabla">Tabla de Clasificación de la NSLA</th>
            </tr>
            <tr class="columnatabla">
              <th title="Logo">Logo</th>
              <th title="Nombre">Nombre</th>
              <th title="Partidos Jugados">PJ</th>
              <th title="Victorias">V</th>
              <th title="Derrotas">D</th>
              <th title="Empates">E</th>
              <th title="Puntos Totales">PT</th>
            </tr>
          </thead>
          <tbody id="tablaBody">
            <xsl:apply-templates select="$equipos"/>
          </tbody>
        </table>
      </div>
    </section>
    
    <a class="boton" href="#active">
      <button class="pasubir">
        <svg class="svgIcon" viewBox="0 0 384 512">
          <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
        </svg>
      </button>
    </a>
  </xsl:template>

  <!-- Plantilla para cada equipo -->
  <xsl:template match="equipo">
    <tr class="divequipos" id="{concat('temporada', ../@numero)}" style="display: none;">
      <td><xsl:value-of select="logo"/></td>
      <td><xsl:value-of select="nombre"/></td>
      <td><xsl:value-of select="partidos_jugados"/></td>
      <td><xsl:value-of select="victorias"/></td>
      <td><xsl:value-of select="derrotas"/></td>
      <td><xsl:value-of select="empates"/></td>
      <td><xsl:value-of select="puntos_totales"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
