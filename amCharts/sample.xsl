<stylesheet version="1.0"
xmlns="http://www.w3.org/1999/XSL/Transform">
<output method="text"/>

    <xsl:template match="/">
            <xsl:call-template match="transaction/transaction-type/@code='C'" name="budget"/>
    </xsl:template>
 
    <xsl:template name="budget">
	    <xsl:for-each select="transaction[transaction-type/@code='C']">
		     <xsl:value-of select="transaction-date"/>: <xsl:value-of select="value"/>
	    </xsl:for-each>
 	</xsl:template>

</stylesheet>
