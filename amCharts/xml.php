<?php
    if(isset($_GET['c'])) {
        $country = $_GET['c'];
        require_once('./iatidata.php');
        $IatiData = new IatiData();

        echo $IatiData->addXmlDeclaration($country);
    }
?>