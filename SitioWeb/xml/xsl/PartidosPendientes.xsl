<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes" />
    <xsl:template match="/">
        <table class="calendinicio" border="1">
            <tbody>
                <tr>
                    <th class="colorpartidos" colspan="6W">Partidos Pendientes</th> <!--Titulo
                    de la tabla-->
                </tr>
                <xsl:for-each select="calendario/jornada[1]/partido">
                    <tr>

                        <td>
                            <img class="escu">
                                <xsl:attribute name="src">
                                    <xsl:choose>
                                        <xsl:when
                                            test="string-length(equipos/equipo1/imagen) &gt; 0">
                                            <xsl:value-of select="concat('SitioWeb/', substring(equipos/equipo1/imagen, 3))"/>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <xsl:text>SitioWeb/imagenes/escudos/escudo.png</xsl:text>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:attribute name="alt">escudoweb</xsl:attribute>
                            </img>
                        </td>
                        <td>
                            <a href="{equipos/equipo1/enlace}" class="club"><!--Equipo-->
                                <xsl:attribute name="href">
                                    <xsl:choose>
                                        <xsl:when test="string(equipos/equipo1/enlace) != ''">
                                            <xsl:value-of select="concat('SitioWeb/', substring(equipos/equipo1/enlace, 3))" />
                                        </xsl:when>
                                        <xsl:otherwise><xsl:text>SitioWeb/html/inicio.html</xsl:text>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:value-of select="equipos/equipo1/nombre" />
                            </a>
                        </td>
                        <td>
                            <p class="vs">vs</p>
                        </td>
                        <td>
                            <a href="{equipos/equipo2/enlace}" class="club"><!--Equipo-->
                                <xsl:attribute name="href">
                                    <xsl:choose>
                                        <xsl:when test="string(equipos/equipo2/enlace) != ''">
                                            <xsl:value-of select="concat('SitioWeb/', substring(equipos/equipo2/enlace, 3))" />
                                        </xsl:when>
                                        <xsl:otherwise><xsl:text>SitioWeb/html/inicio.html</xsl:text>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:value-of select="equipos/equipo2/nombre" />
                            </a>
                        </td>
                        <td>
                            <img class="escu">
                                <xsl:attribute name="src">
                                    <xsl:choose>
                                        <xsl:when
                                            test="string-length(equipos/equipo2/imagen) &gt; 0">
                                            <xsl:value-of select="concat('SitioWeb/', substring(equipos/equipo2/imagen, 3))" />
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <xsl:text>../../imagenes/escudos/escudo.png</xsl:text>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:attribute name="alt">escudoweb</xsl:attribute>
                            </img>
                        </td>
                    </tr>
                    <tr>

                        <td></td>
                        <td colspan="3">
                            <hr />
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>

</xsl:stylesheet>