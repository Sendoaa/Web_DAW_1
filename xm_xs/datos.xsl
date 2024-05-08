<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html lang="es">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>NSLA-Equipos</title>
        <link rel="stylesheet" href="../estilos/styles.css" />  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
        <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png" />
        <script>
          function mostrarEquipos(temporada) {
            var equipos = document.querySelectorAll('.divequipos');
            equipos.forEach(function(equipo) {
              if (equipo.id === temporada) {
                equipo.style.display = 'block';
              } else {
                equipo.style.display = 'none';
              }
            });
          }

          window.onload = function() {
            mostrarEquipos('temporada2023');
          };
        </script>
      </head>
      <body>
        <select id="temporada" onchange="mostrarEquipos(this.value)">
          <xsl:for-each select="//temporada">
            <option value="{@num}">
              <xsl:value-of select="concat('Temporada ', @num)"/>
            </option>
          </xsl:for-each>
        </select>

        <xsl:apply-templates select="//equiposliga" />

        <a class="boton" href="#active">
          <button class="pasubir">
            <svg class="svgIcon" viewBox="0 0 384 512">
              </svg>
          </button>
        </a>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="equiposliga">
    <xsl:for-each select="equipo">
      <section>
        <div class="divequipos" id="{concat('temporada', ../@num)}" style="display: none;">
          <details id="{nombreequipo/nombre}">
            <summary class="toggle-summary">
              <p><xsl:value-of select="nombreequipo/nombre"/></p>
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
                <p><xsl:value-of select="entrenador/nombre"/></p>
              </div>
            </div>
            <hr />
            <h1>Jugadores:</h1>

            <template match="jugadores/*">
              <h4><u><xsl:value-of select="name()" /></u></h4>
              <div class="divjugadores">
                <xsl:for-each select=".">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}" />
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
                </xsl:for-each>
              </div>
            </template>

          </details>
        </div>
      </section>
    </xsl:for-each>
  </xsl:template>

</xsl:stylesheet>
