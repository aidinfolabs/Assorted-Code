<?php

    if(isset($_GET['c'])) {
            $country = $_GET['c'];
        //else $country = 'AO';

        $xml = new DOMDocument();
        $xmlurl = ('http://projects.dfid.gov.uk/iati/country/' . $country);
        $xml->load($xmlurl);
        $xsl = new DOMDocument();
        $xsl->load('iati-budget.xsl');
        $xslt = new XsltProcessor();
        $xslt->importStylesheet($xsl);
        $result = $xslt->transformToDoc($xml);
        //echo $country . ' ' . $xmlurl;
        echo $result->saveXML();
    }
    
?>