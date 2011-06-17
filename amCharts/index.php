<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
    if(isset($_GET['c'])) {
        $country = $_GET['c'];
        require_once('./iatidata.php');
        $IatiData = new IatiData();
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>IATI Test Pages using DFID data</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="./xslt.js"></script>
		<script type="text/javascript" src="./jquery.xslt.js"></script>
		<link rel="stylesheet" href="./iati.css" type="text/css"></link>

        		<!-- amcharts script-->

		<!-- swf object (version 2.2) is used to detect if flash is installed and include swf in the page -->
		<script type="text/javascript" src="./amcharts/flash/swfobject.js"></script>

		<!-- following scripts required for JavaScript version. The order is important! -->
		<script type="text/javascript" src="./amcharts/javascript/amcharts.js"></script>
		<script type="text/javascript" src="./amcharts/javascript/amfallback.js"></script>
		<script type="text/javascript" src="./amcharts/javascript/raphael.js"></script>

	    <script type="text/javascript">

            var params = {
                bgcolor:"#FFFFFF"
                };

		    var flashVars = {
		        path: "./amcharts/flash/",
		        settings_file: encodeURIComponent("./column_settings.xml"),
                //data_file: encodeURIComponent("./budgets.php?c=<?php //echo $country; ?>")
                data_file: encodeURIComponent("./charts.php?chart=bar&c=<?php echo $country; ?>")
			};
		    var flashPieVars = {
		        path: "./amcharts/flash/",
		        settings_file: encodeURIComponent("./pie_settings.xml"),
                data_file: encodeURIComponent("./charts.php?chart=pie&c=<?php echo $country; ?>")
			};
		        //data_file: encodeURIComponent("./budgets.php?c=<?php //echo $country; ?>")

			// change 8 to 80 to test javascript version
            if (swfobject.hasFlashPlayerVersion("8")){
	    		swfobject.embedSWF("./amcharts/flash/amcolumn.swf", "chartdiv", "600", "400", "8.0.0", "../../amcharts/flash/expressInstall.swf", flashVars, params);
	    		swfobject.embedSWF("./amcharts/flash/ampie.swf", "piechartdiv", "600", "400", "8.0.0", "../../amcharts/flash/expressInstall.swf", flashPieVars, params);
	    	}
			else{
				var amFallback = new AmCharts.AmFallback();
				 amFallback.settingsFile = flashVars.settings_file;  		// doesn't support multiple settings files or additional_chart_settins as flash does
				 amFallback.dataFile = flashVars.data_file;
				//amFallback.chartSettings = flashVars.chart_settings;
				amFallback.pathToImages = "./amcharts/javascript/images/";
				//amFallback.chartData = flashVars.chart_data;
				amFallback.type = "column";
				amFallback.write("chartdiv");
			}

		</script>

		<!-- end of amcharts script -->

	</head>
	<body>
		<div id="header">
			<h1>Dogfood: Playing with IATI</h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="../index.php">Text Transformation</a></li>
				<li><a href="../dfidprojects.html">Exhibit</a></li>
                <li><a href="index.php">Charts</a></li>
			</ul>
		</div>

		<div id="content">
			<form action="index2.php" method="get">
				Please enter a 2-letter country code: <input type="text" name="c" />
				<input type="submit" />
                <?php
                if(isset($_GET['c'])) {
                    $countryName = $IatiData->countryName($country);
                    echo "<div id='label'>You selected country: <strong>" . $countryName . " (" .$country . ")</strong></div>";
                }
                ?>

			</form>
            <?php
            if(isset($_GET['c'])) {?>
                <!-- chart is placed in this div. if you have more than one chart on a page, give unique id for each div -->
                <div id="chartdiv" style="width:600px; height:400px; background-color:#aaa"></div>
                <div id="piechartdiv" style="width:600px; height:400px; background-color:#aaa"></div>



            <?php
                //echo $IatiData->sectors($country);
                //echo $sector;
            } ?>

		</div>

	</body>
</html>