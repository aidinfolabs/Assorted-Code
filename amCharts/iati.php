<?php
class IataData
{
    // property declaration
    public $country = "";
    public $rootUrl = 'http://projects.dfid.gov.uk/iati/country/';

    // method declaration
    public function setCountry() {
        if(isset($_GET['c'])) {
            $this->country = $_GET['c'];
            return $this->country;
        }
    }

    public function countryBudgetData($country) {
        $xml = new DOMDocument();
        $xmlurl = ($this->rootUrl . $country);
        $xml->load($xmlurl);
        $xsl = new DOMDocument();
        $xsl->load('iati-budget.xsl');
        $xslt = new XsltProcessor();
        $xslt->importStylesheet($xsl);
        $result = $xslt->transformToDoc($xml);
        //echo $country . ' ' . $xmlurl;
        echo $result->saveXML();
    }
}
?>