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
      </head>
      <body onload="mostrarClasificacionPredeterminada()">
        <xsl:apply-templates select="temporadas/temporada"/>
          <script>
            function mostrarClasificacionPredeterminada() {
              mostrarClasificacion('2023');
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
              document.getElementById('temporada').value = temporada;
            }
          </script>
      </body>
    </html>
  </xsl:template>

  <!-- Plantilla para la clasificación -->
  <xsl:template match="temporada">
    <xsl:variable name="tituloTemporada" select="numero"/>
    <xsl:variable name="equipos" select="equiposliga/equipo"/>

    <div class="select">
     <!-- Selector de temporada -->
     <select id="temporada" onchange="mostrarClasificacion(this.value)">
      <xsl:for-each select="//temporada">
        <option value="{numero}">
          <xsl:value-of select="concat('TEMPORADA ', numero)" />
        </option>
      </xsl:for-each>
    </select>
    </div>

    <section>
      <h1 id="{concat('tituloTemporada', numero)}" class="titulin">
        <xsl:value-of select="$tituloTemporada"/>
      </h1>
      <div class="divtabla" id="{concat('temporada', numero)}">
        <table id="{concat('tablaclasi', numero)}" class="tablaclasi">
          <thead>
            <tr>
              <th colspan="6" class="titulotabla">Tabla de Clasificación de BOF</th>
            </tr>
            <tr class="columnatabla">
              <th title="Logo">Logo</th>
              <th title="Nombre">Nombre</th>
              <th title="Partidos Jugados">PJ</th>
              <th title="Victorias">V</th>
              <th title="Derrotas">D</th>
              <th title="Puntos Totales">PT</th>
            </tr>
          </thead>
          <tbody id="{concat('tablaBody', numero)}">
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
    <xsl:variable name="nombre_equipo" select="nombreequipo/nombre"/>
    <xsl:variable name="escudo_equipo" select="escudo"/>
    <xsl:variable name="partidos_jugados" select="count(../../jornada/partido[equipos/local = $nombre_equipo or equipos/visitante = $nombre_equipo])"/>
    <xsl:variable name="victorias" select="count(../../jornada/partido[equipos/local = $nombre_equipo and number(equipos/puntoslocal) &gt; number(equipos/puntosvisitante)]) + count(../../jornada/partido[equipos/visitante = $nombre_equipo and number(equipos/puntosvisitante) &gt; number(equipos/puntoslocal)])"/>
    <xsl:variable name="derrotas" select="count(../../jornada/partido[equipos/local = $nombre_equipo and number(equipos/puntoslocal) &lt; number(equipos/puntosvisitante)]) + count(../../jornada/partido[equipos/visitante = $nombre_equipo and number(equipos/puntosvisitante) &lt; number(equipos/puntoslocal)])"/>
    <xsl:variable name="puntos_totales" select="$victorias * 3"/>

    <tr class="divequipos">
      <td><img src="{$escudo_equipo}" alt="{$nombre_equipo}" style="width: 50px; height: auto;" /></td>
      <td><xsl:value-of select="$nombre_equipo"/></td>
      <td><xsl:value-of select="$partidos_jugados"/></td>
      <td><xsl:value-of select="$victorias"/></td>
      <td><xsl:value-of select="$derrotas"/></td>
      <td><xsl:value-of select="$puntos_totales"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
