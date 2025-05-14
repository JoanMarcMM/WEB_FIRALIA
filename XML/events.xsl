<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" indent="yes" />
  <xsl:template match="/catalogo">
    <html><body>
      <h1>Eventos</h1>
      <ul>
        <xsl:for-each select="event">
          <li>
            <xsl:value-of select="name" /> -
            <xsl:value-of select="type" /> -
            <xsl:value-of select="start_date" /> -
            <xsl:value-of select="end_date" /> -
            <xsl:value-of select="about" /> -
            <xsl:value-of select="price" />
          </li>
        </xsl:for-each>
      </ul>
    </body></html>
  </xsl:template>
</xsl:stylesheet>