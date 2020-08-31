<?php

// use dosamigos\leaflet\types\Icon;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\GeoJson;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\Circle;
use dosamigos\leaflet\layers\Polygon;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;
use yii\helpers\Html;

use dosamigos\leaflet\plugins\makimarker\MakiMarker;

use dosamigos\leaflet\plugins\geocoder\ServiceNominatim;
use dosamigos\leaflet\plugins\geocoder\GeoCoder;
?>

<div class="col-sm-10 batas-kiri">

<?php
// lets use nominating service
$nominatim = new ServiceNominatim();
// Initialize plugin
$makimarkers = new MakiMarker(['name' => 'makimarker']);

// create geocoder plugin and attach the service
$geoCoderPlugin = new GeoCoder([
    'service' => $nominatim,
    'clientOptions' => [
        // we could leave it to allocate a marker automatically
        // but I want to have some fun
        'showMarker' => false
    ]
]);

foreach ($dataProvider->getModels() as $key => $value) :
    // $center = new LatLng(['lat' => 51.508, 'lng' => -0.11]);
    $center2 = new LatLng(['lat' => -7.6560881, 'lng' => 111.3249235]);
    $center = new LatLng(['lat' => $value['lat'], 'lng' => $value['lng']]);
    $marker2 = new Marker([
        'latLng' => $center2,
        'icon' => $makimarkers->make("religious-muslim",['color' => "#2196f3", 'size' => "m"]), 
        'popupContent' => "masjid Agung"]);

    $marker[] = new Marker([
        'name' => 'geoMarker',
        'latLng' => $center,
        'icon' => $makimarkers->make("commercial",['color' => "#b0b", 'size' => "m"]),
        // "iconUrl" => "favicon.ico",
        'popupContent' => $value['keterangan'],
    ]);
endforeach;

// configure the tile layer
$tileLayer = new TileLayer([
    'urlTemplate' => 'https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=7Pw3clcBKFXUjMH15Bhu',
    'clientOptions' => [
        'attribution' => 'Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> ' .
            '<img src="http://developer.mapquest.com/content/osm/mq_logo.png">, ' .
            'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' .
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        'subdomains' => '1234'
    ]
]);

// initialize our leafLet component
$leafLet = new LeafLet([
    'name' => 'geoMap',
    'tileLayer' => $tileLayer,
    'center' => $center2,
    'zoom' => 13,
]);

foreach ($dataProvider->getModels() as $key => $value) :

$leafLet->addLayer($marker[$key]);

endforeach;

// $leafLet->addLayer($polygon);

// // add the marker
// $leafLet->addLayer($marker);
$leafLet->addLayer($marker2);

// install
$leafLet->installPlugin($makimarkers);

// install the plugin
$leafLet->installPlugin($geoCoderPlugin);

// run the widget (you can also use dosamigos\leaflet\widgets\Map::widget([...]))
echo $leafLet->widget([
    'options' => [
        'style' => 'height: 590px',]
]);
?>
</div>

<div class="col-sm-2 batas-kanan">

Checkbox: 
<label class="container1">One
  <input type="checkbox" id="myCheck" onclick="myFunction()" checked="checked">
  <span class="checkmark"></span>
  <p id="geoMap" >Checkbox is CHECKED!</p>
</label>
</div>

<script>
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("geoMap");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
} 
</script>