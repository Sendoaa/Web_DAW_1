<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <table border="1" id="clasificaciontabla" class="clasificaciontabla">
            <tbody>
                <tr>
                    <th class="color" colspan="10">Clasificacion Temporada <xsl:value-of
                            select="tabla/tempActual" /></th>
                </tr>
                <tr>
                    <th class="clasificacion">Posicion</th>
                    <th class="clasificacion">Equipo</th>
                    <th class="clasificacion"></th>
                    <th class="clasificacion">G</th><!--Ganados -->
                    <th class="clasificacion">E</th><!--Empates -->
                    <th class="clasificacion">P</th><!--Perdidos -->
                    <th class="clasificacion">J</th><!--Jugados -->
                    <th class="clasificacion">PF</th><!--Puntos a favor -->
                    <th class="clasificacion">PC</th><!--Puntos en contra -->
                    <th class="clasificacion">PT</th><!--Puntos Totales-->
                </tr>

                <xsl:variable name="maxCount" select="9" />
                <xsl:variable name="rowCount" select="count(tabla/club)" />
                <xsl:for-each select="tabla/club">
                    <xsl:sort select="puntuacion/G" data-type="number" order="descending" />
                    <xsl:sort select="puntuacion/E" data-type="number" order="descending" />
                    <xsl:sort select="puntuacion/P" data-type="number" order="ascending" />
                    <xsl:sort select="puntuacion/PC" data-type="number" order="ascending" />
                    <xsl:sort select="puntuacion/PF" data-type="number" order="descending" />
                    <xsl:sort select="puntuacion/PT" data-type="number" order="descending" />   
                    <tr id="puntos">
                        <td><xsl:value-of select="position()" /><!--Posicion --></td>
                        <td>
 
                                <xsl:attribute name="href">
                                        <xsl:choose>
                                            <xsl:when test="string(equipo/enlace) != ''">
                                                <xsl:value-of select="equipo/enlace" />
                                            </xsl:when>
                                            <xsl:otherwise><xsl:text>../../html/inicio.html
                                            </xsl:text></xsl:otherwise>
                                        </xsl:choose>
                                    </xsl:attribute>
                                    <xsl:attribute name="alt">escudoweb</xsl:attribute>
                                <img class="escu">
                                    <xsl:attribute name="src">
                                        <xsl:choose>
                                            <xsl:when test="string(equipo/imagen) != ''">
                                                <xsl:value-of select="equipo/imagen" />
                                            </xsl:when>
                                            <xsl:otherwise><xsl:text>../../imagenes/escudos/escudo.png
                                            </xsl:text></xsl:otherwise>
                                        </xsl:choose>
                                    </xsl:attribute>
                                    <xsl:attribute name="alt">escudoweb</xsl:attribute>
                                </img>
                        </td>
                        <td>
                                <xsl:attribute name="href">
                                    <xsl:choose>
                                        <xsl:when test="string(equipo/enlace) != ''">
                                            <xsl:value-of select="equipo/enlace" />
                                        </xsl:when>
                                        <xsl:otherwise><xsl:text>../../html/inicio.html
                                        </xsl:text> </xsl:otherwise>
                                    </xsl:choose>
                                </xsl:attribute>
                                <xsl:value-of select="equipo/nombre" />
                        </td>
                        <td><xsl:value-of select="puntuacion/G" /></td>
                        <td><xsl:value-of select="puntuacion/E" /></td>
                        <td><xsl:value-of select="puntuacion/P" /></td>
                        <td><xsl:value-of select="puntuacion/J" /></td>
                        <td><xsl:value-of select="puntuacion/PF" /></td>
                        <td><xsl:value-of select="puntuacion/PC" /></td>
                        <td><xsl:value-of select="puntuacion/PT" /></td>
                    </tr>
                    <xsl:if test="position() &lt; $rowCount or position() &lt; $maxCount">
                        <tr>
                            <td colspan="10"><hr /></td>
                        </tr>
                    </xsl:if>
                </xsl:for-each>
            </tbody>
        </table>
    </xsl:template>
</xsl:stylesheet>
