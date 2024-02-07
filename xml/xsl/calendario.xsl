<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes" />

    <xsl:variable name="imagenPorDefecto1">imagen_por_defecto_equipo1.jpg</xsl:variable>
    <xsl:variable name="imagenPorDefecto2">imagen_por_defecto_equipo2.jpg</xsl:variable>

    <xsl:template match="jornada">
        <section class="calendario" id="Temporada1">
            <table class="calend" border="1">
                <tbody>
                    <tr>
                        <th class="color" colspan="6W">Jornada <xsl:value-of select="NumJornada" />
        (<xsl:value-of select="FechaInicio/dia" />/<xsl:value-of select="FechaInicio/mes" />/<xsl:value-of
                                select="FechaInicio/año" />)</th>
                    </tr>
                    <xsl:apply-templates select="partido" />
                </tbody>
            </table>
        </section>
    </xsl:template>

    <xsl:template match="partido">
        <tr>
            <td>
                <img class="escu">
                    <xsl:attribute name="src">
                        <xsl:choose>
                            <xsl:when test="string-length(equipos/equipo1/imagen) &gt; 0">
                                <xsl:value-of select="equipos/equipo1/imagen" />
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:text>../../imagenes/escudos/escudo.png</xsl:text>
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
                                <xsl:value-of select="equipos/equipo1/enlace" />
                            </xsl:when>
                            <xsl:otherwise><xsl:text>../../html/inicio.html</xsl:text>
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
                                <xsl:value-of select="equipos/equipo2/enlace" />
                            </xsl:when>
                            <xsl:otherwise><xsl:text>../../html/inicio.html</xsl:text>
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
                            <xsl:when test="string-length(equipos/equipo2/imagen) &gt; 0">
                                <xsl:value-of select="equipos/equipo2/imagen" />
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
            <td>
                <b>
                    <xsl:value-of select="equipos/equipo1/canastas" />
                </b>
            </td>
            <td>
                <b>-</b>
            </td>
            <td>
                <b>
                    <xsl:value-of select="equipos/equipo2/canastas" />
                </b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <hr />
            </td>
        </tr>
    </xsl:template>
</xsl:stylesheet>