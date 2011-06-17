<?php
class IatiData
{
    // property declaration
    public $country;
    public $rootUrl = 'http://projects.dfid.gov.uk/iati/country/';

    //constructor
    public function IatiData() {
        $this->setCountry();
    }

    // method declaration
    public function setCountry() {
        if(isset($_GET['c'])) {
            $this->country = $_GET['c'];
            return $this->country;
        }
    }

    public function countryName($country) {
        $xml = new SimpleXMLElement($this->rootUrl . $country, null, true);
        $xarray = $xml->xpath("//recipient-country");
        return ($xarray[0]);
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
        echo $result->saveXML();
    }

    public function sectors($country) {
        $xml = new DOMDocument();
        $xmlurl = ($this->rootUrl . $country);
        $xml->load($xmlurl);
        $xsl = new DOMDocument();
        $xsl->load('iati-sector.xsl');
        $xslt = new XsltProcessor();
        $xslt->importStylesheet($xsl);
        $result = $xslt->transformToDoc($xml);
        //echo $result->saveXML() . "-----";

        //echo "start sectors";
        $sectors = new DOMDocument();
        $sectors->loadXML($result->saveXML());
        //echo $sectors->saveXML(). "=====";
        $sectorsXsl = new DOMDocument();
        $sectorsXsl->load('iati-sectorcalc.xsl');
        $sectorsXslt = new XsltProcessor();
        $sectorsXslt->importStylesheet($sectorsXsl);
        $sectorsResult = $sectorsXslt->transformToDoc($sectors);
        echo $sectorsResult->saveXML();
    }

    public function topTen($country,$by) {
        $xml = new SimpleXMLElement($this->rootUrl . $country, null, true);
        $xarray = $xml->xpath("//recipient-country");
        return ($xarray[0]);
    }

    public function addXmlDeclaration($country) {
        $xml = new DOMDocument();
        $xmlurl = ($this->rootUrl . $country);
        $xml->load($xmlurl);
        $xsl = new DOMDocument();
        $xsl->load('iati-addxmldecl.xsl');
        $xslt = new XsltProcessor();
        $xslt->importStylesheet($xsl);
        $result = $xslt->transformToDoc($xml);
        echo $result->saveXML();
    }
}
?>