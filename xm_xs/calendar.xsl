<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:variable name="temporadasDoc" select="document('temporadas.xml')"/>

    <xsl:template match="/">
        <html lang="es">
            <head>
                <meta charset="UTF-8"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <title>NSLA-Calendario</title>
                <link rel="stylesheet" href="../estilos/styles.css"/>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"/>
                <link rel="icon" type="image/x-icon" href="../imagenes/logos/nofondo.png"/>
                <script type="text/javascript">
                    <![CDATA[
                    // Función que se ejecutará cuando se seleccione una temporada en el menú desplegable
                    function cambiarTemporada(select) {
                        // Obtener el valor seleccionado
                        var temporadaSeleccionada = select.value;
                    
                        // Obtener el número de temporada (eliminar la extensión ".xml" si está presente)
                        var numeroTemporada = temporadaSeleccionada.replace(".xml", "");
                    
                        // Realizar la solicitud AJAX si se ha seleccionado una temporada
                        if (numeroTemporada) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Limpiar el contenido existente antes de agregar el nuevo contenido
                                    document.getElementById("contenidoXML").innerHTML = '';
                    
                                    // Actualizar el contenido XML
                                    document.getElementById("contenidoXML").innerHTML = this.responseText;
                                }
                            };
                            xhttp.open("GET", "calendario.php?temporada=" + numeroTemporada, true);
                            xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Añadir la cabecera X-Requested-With
                            xhttp.send();
                        } else {
                            console.error('Por favor, selecciona una temporada antes de continuar.');
                        }
                    }
                    ]]>
                </script>
            </head>
            <body>
                <div class="select">
                    <select id="seleccionarPagina" onchange="cambiarTemporada(this)">
                        <option value="">Selecciona una Temporada</option>
                        <!-- Iterar sobre las temporadas cargadas desde temporadas.xml -->
                        <xsl:for-each select="$temporadasDoc//temp">
                            <option value="{.}">
                                TEMPORADA <xsl:value-of select="."/>
                            </option>
                        </xsl:for-each>
                    </select>
                </div>
                <h1 class="titulin"><u><xsl:value-of select="temporada/numtemp"/></u></h1>
                <nav class="sidebar" id="sidebar">
                    <details>
                        <summary>Jornadas</summary>
                        <ul>
                            <xsl:apply-templates select="//jornada" mode="menu"/>
                        </ul>
                    </details>
                </nav>
                <a class="boton" href="#active"><button class="pasubir">
                    <svg class="svgIcon" viewBox="0 0 384 512">
                        <path
                            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                        ></path>
                    </svg>
                </button></a>
                <xsl:apply-templates select="//jornada"/>
                <script src="../scripts/temporadas.js"></script>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="jornada" mode="menu">
        <li><a href="#jornada_{@num}">Jornada <xsl:value-of select="@num"/></a></li>
    </xsl:template>

    <xsl:template match="jornada">
        <h1 class="jornada" id="jornada_{@num}">Jornada <xsl:value-of select="@num"/></h1>
        <div class="divpartidos">
            <xsl:apply-templates select="partido"/>
        </div>
    </xsl:template>

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
