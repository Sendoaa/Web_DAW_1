<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html lang="es">
      <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>NSLA-Equipos</title>
        <link rel="stylesheet" href="../estilos/styles.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"/>
        <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png"/>
      </head>
      <body>
        <xsl:apply-templates select="//equipos"/>
        <a class="boton" href="#active"><button class="pasubir">
          <svg class="svgIcon" viewBox="0 0 384 512">
            <path
              d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
            ></path>
          </svg>
        </button></a>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="equipos">
    <xsl:for-each select="equipo">
      <section>
        <div class="divequipos">
          <details id="{nombreequipo/nombre}">
            <summary class="toggle-summary">
              <p><xsl:value-of select="nombreequipo/nombre"/></p> 
              <span class="toggle-button">▶</span>
            </summary>
            <h1>Escudo:</h1>
            <div class="divjugadores">
              <div>
                <img class="escudo" src="{escudo}" alt="{escudo}"/>
              </div>
            </div>
            <h1>Entrenador:</h1>
            <div class="divjugadores">
              <div>
                <img class="fotoequipos" src="{entrenador/imagen}" alt="{entrenador/nombre}"/>
                <p><xsl:value-of select="entrenador/nombre"/></p>
              </div>
            </div>
            <hr/>
            <h1>Jugadores:</h1>
            <!-- Filtra y ordena los jugadores por posición -->
            <h4><u>LB</u></h4>
              <div class="divjugadores">
                <xsl:for-each select="jugadores/LB/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
                </xsl:for-each>
              </div>
            <h4><u>SAF</u></h4>
            <div class="divjugadores">
              <xsl:for-each select="jugadores/SAF/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
              </xsl:for-each>
            </div>
            <h4><u>WR</u></h4>
            <div class="divjugadores">
              <xsl:for-each select="jugadores/WR/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
              </xsl:for-each>
            </div>
            <h4><u>CB</u></h4>
            <div class="divjugadores">
              <xsl:for-each select="jugadores/CB/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
              </xsl:for-each>
            </div>
            <h4><u>QB</u></h4>
            <div class="divjugadores">
              <xsl:for-each select="jugadores/QB/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
              </xsl:for-each>
            </div>
            <h4><u>DT</u></h4>
            <div class="divjugadores">
              <xsl:for-each select="jugadores/DT/jugador">
                  <div class="jugador">
                    <img class="fotoequipos" src="{imagen}" alt="{nombre}"/>
                    <p><xsl:value-of select="nombre"/></p>
                  </div>
              </xsl:for-each>
            </div>
          </details>
        </div>
      </section>
    </xsl:for-each>
  </xsl:template>

</xsl:stylesheet>
