<?php

/**

Usage : 
API : https://hackdex.ml/plotter/
DATA :
showPath=false
showArea=false
zoom=12
locations=55.05,-0.09,1,Test%201|55.04,-0.09,8,Test%202


Show Polygon Area Between Points,
use the parameter,
showArea=true

Show Path Of Points ( required for Polygon Area )
use parameter,
showPath=true

Change Start Zoom
use parameter,
zoom=1 to 20

Set Locations as follows,
locations seperated by "|" character, in the following format...

Lattitude, Longitude, Radius, url encoded Title html   |   Lattitude, Longitude, Radius, url encoded Title html   

 etc.....

Without Whitespace Characters.

Example,
https://hackdex.ml/plotter/?showPath=true&showArea=true&zoom=12&locations=55.05,-0.09,1,Test%201|55.04,-0.09,8,Test%202|55.02,-0.04,4,Test%203

**/


$token = "";
 

$locations = array("51.5,-0.09,6,This%20is%20a%20example%20at%2051.504");
$zoom= "17";


if(hasParam('locations'))
{
$get = urldecode($_REQUEST["locations"]);
$locations = explode("|",$get); 
}

$path = "";
$polyType = "line";
$showPath= false;
if(hasParam("showPath"))
{
$showPath = ($_REQUEST["showPath"] == "true");
}

if(hasParam("showArea") && ($_REQUEST["showArea"] == "true"))
{
$polyType = "gon";
}

if(hasParam('zoom'))
{
$zoom = htmlspecialchars($_REQUEST['zoom']);
}
$init = "";
$data = "";

$first = true;

foreach($locations as $location)
{
$bits = explode(",",$location);
$lat = htmlspecialchars($bits[0]);
$lon = htmlspecialchars($bits[1]);
$radius = htmlspecialchars($bits[2]);
$name = urldecode($bits[3]);
if ($first)
{
 $init = $lat.", ".$lon;
}

$data .= 'L.marker(['.$lat.', '.$lon.']).addTo(mymap)
		.bindPopup("'.$name.'").openPopup().closePopup();


	L.circle(['.$lat.', '.$lon.'], '.$radius.', {
		color: \'white\',
		fillColor: \'blue\',
		fillOpacity: 0.5
	}).addTo(mymap);
';

 $path .= "[". $lat.", ".$lon."],";

$first = false;
}
$path = substr($path,0,strlen($path)-1);

function hasParam($param) 
{
   return array_key_exists($param, $_REQUEST);
}

?>


<!DOCTYPE html>
<html>
<head>
	
	<title>GPS Plotter</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


	
</head>
<body>


<div id="map" style="width:102vw; height:105vh;margin:-10px;border:0px;"></div>
<script>

	var mymap = L.map('map').setView([<?php echo $init; ?>],<?php echo $zoom; ?>);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=<?php echo $token ?>', {
		maxZoom: 20,
		attribution: '',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(mymap);

	<?php echo $data; ?>



	var popup = L.popup();

<?php
if($showPath)
{
echo '
	L.poly'.$polyType.'([
		'.$path.'
	]).addTo(mymap).bindPopup("I am a polygon.");
';
}
?>
/**
	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("You clicked the map at " + e.latlng.toString())
			.openOn(mymap);
	}
mymap.on('click', onMapClick);
**/


	

</script>



</body>
</html>
