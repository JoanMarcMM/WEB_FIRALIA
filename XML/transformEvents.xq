xquery version "3.1";
 
import module namespace xslt = "http://basex.org/modules/xslt";
 
let $xml := file:read-text("events.xml")
let $xsl := file:read-text("events.xsl")
return xslt:transform-text($xml, $xsl)