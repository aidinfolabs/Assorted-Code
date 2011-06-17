<?php
    require_once('./iatidata.php');
    $IatiData = new IatiData();

    if(isset($_GET['c'])) {
            $country = $_GET['c'];

            if(isset($_GET['chart'])) {
                $chart = $_GET['chart'];

                switch($chart) {
                    case "pie":
                        echo $IatiData->sectors($country);
                        break;
                    case "bar":
                        echo $IatiData->countryBudgetData($country);
                        break;
                    default:
                        echo $country . " " . $chart . "--";
                        break;
                }
            }
    }
    
?>