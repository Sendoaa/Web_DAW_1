<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <table border="1" class="clubinicio">
            <tbody>
                <tr>
                    <th class="colornotic" colspan="2">
                        <div class="vertical-center"> <!--Titulo de la tabla--> Clubes </div>
                        <div class="vertical-center2">
                            <a href="SitioWeb/html/clubes.html" class="linkanoticias">Ver todos los clubes</a> <!-- Boton que redirige a la seccion clubes-->
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Escudo</th> <!--Columna donde se muestran los escudos de los clubes -->
                    <th>Nombre</th> <!--Columna donde se muestran los nombres de los clubes-->
                </tr>
                <xsl:for-each select="clubes/equipo[position() &lt;= 5]">
                    <tr>
                        <td>
                            <a>
                                <xsl:attribute name="href">
                                    <xsl:choose>
                                        <xsl:when test="string(escudo/enlace) != ''">
                                            <xsl:value-of select="concat('SitioWeb/', substring(escudo/enlace, 3))" />
                                        </xsl:when>
                                        <xsl:otherwise><xsl:text>../../html/inicio.html
                                        </xsl:text> </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <img class="escu">
                                    <xsl:attribute name="src">
                                        <xsl:choose>
                                            <xsl:when test="string-length(escudo/imagen) &gt; 0">
                                                <xsl:value-of select="concat('SitioWeb/', substring(escudo/imagen, 3))"/>
                                            </xsl:when>
                                            <xsl:otherwise>
                                                <xsl:text>../../imagenes/escudos/escudo.png
                                                </xsl:text> <!-- Coloca aquí la ruta de tu imagen por defecto -->
                                            </xsl:otherwise>
                                        </xsl:choose>
                                    </xsl:attribute>
                                    <xsl:attribute name="alt">Escudo</xsl:attribute>
                                </img>
                            </a> <!--Escudo del club (Te redirige a su correspondiente pagina) -->
                        </td>
                        <td>
                            <a class="club">
                                <xsl:attribute name="href">
                                    <xsl:choose>
                                        <xsl:when test="string(escudo/enlace) != ''">
                                            <xsl:value-of select="concat('SitioWeb/', substring(escudo/enlace, 3))" />
                                        </xsl:when>
                                        <xsl:otherwise><xsl:text>../../html/inicio.html
                                        </xsl:text> </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:value-of select="nombre" />
                            </a> <!--Nombre del club (Te redirige a su correspondiente pagina) -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr />
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>
</xsl:stylesheet>
