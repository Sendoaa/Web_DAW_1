<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <div>
            <center><h1>Informacion sobre <xsl:value-of select="Paginaclubes/club/nombre" /></h1></center>
            <img src="{Paginaclubes/club/imagen}" class="EscudoclubInfo" />
            <h2>Info sobre nuestro club</h2>
                                <p><xsl:value-of select="Paginaclubes/club/descripcion" /></p>
                                <h2>Nuestros jugadores</h2>
                                <p>En <xsl:value-of select="Paginaclubes/club/nombre" />,
        albergamos equipos de todas las edades, desde los más jóvenes hasta los veteranos. Nuestra
        cantera es el corazón de nuestro club, donde los jóvenes talentos pueden crecer y
        desarrollarse como jugador y como individuos. Además, contamos con equipos competitivos en
        diferentes ligas y categorías, lo que nos permite competir a nivel local y regional.</p>
        <table border="1" class="tabla-pagclub"><!--Tabla
            de equipos -->
            <tbody>
                <tr>
                    <th class="color" colspan="3">JUGADORES</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Localidad</th>
                    <th>Edad</th>
                </tr>
                <xsl:for-each select="Paginaclubes/club/equipo/Jugadores">
                    <tr>
                        <td>
                            <xsl:value-of select="nombre" />
                            <xsl:value-of select="Paginaclubes/club/equipo/jugadores/apellido" />
                        </td>
                        <td>
                            <xsl:value-of select="nacionalidad" />
                        </td>
                        <td>
                            <xsl:value-of select="posicion" />
                        </td>
                    </tr>
                                        <tr>
                        <td colspan="3">
                            <hr />
                        </td>
                    </tr>
                </xsl:for-each>
            </tbody>
        </table>
        </div>
    </xsl:template>
    
</xsl:stylesheet>