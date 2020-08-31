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

// $iconUrl = new Icon();
// print_r($iconUrl);
// exit;
// $iconUrl->iconUrl='http://leafletjs.com/examples/custom-icons/leaf-green.png';


foreach ($dataProvider->getModels() as $key => $value) :

$center = new LatLng(['lat' => $value['lat'], 'lng' => $value['lng']]);
// $marker[] = new Marker(['latLng' => $center, 'popupContent' => $value['keterangan']]);
$marker[] = new Marker([
    'latLng' => $center,
    'popupContent' => $value['keterangan'],
    'options' => [
        'icon' => 'http://leafletjs.com/examples/custom-icons/leaf-green.png',
    ]
]);


endforeach;

$tileLayer = new TileLayer([
   'urlTemplate' => 'https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=7Pw3clcBKFXUjMH15Bhu',
    'clientOptions' => [
        'attribution' => 'Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> ' .
        '<img src="http://developer.mapquest.com/content/osm/mq_logo.png">, ' .
        'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        'subdomains' => '1234',
    ],
]);

$leaflet = new LeafLet([
    'tileLayer' => $tileLayer,
    'center' => $center,
]);

foreach ($dataProvider->getModels() as $key => $value) :

$leaflet->addLayer($marker[$key]);

endforeach;

// finally render the widget
// echo Map::widget(['leafLet' => $leaflet]);

// we could also do
// echo $leaflet->widget();

echo $leaflet->widget([
    'options' => [
        'style' => 'height: 590px',
        ]]);





// use dosamigos\leaflet\layers\TileLayer;
// use dosamigos\leaflet\LeafLet;
// use dosamigos\leaflet\types\LatLng;
// use dosamigos\leaflet\layers\Marker;
// use dosamigos\leaflet\plugins\geocoder\ServiceNominatim;
// use dosamigos\leaflet\plugins\geocoder\GeoCoder;

// use dosamigos\leaflet\widgets\Map;
// use yii\helpers\Html;

// use dosamigos\leaflet\plugins\makimarker\MakiMarker;

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
    $center = new LatLng(['lat' => $value['lat'], 'lng' => $value['lng']]);
    // $marker[] = new Marker(['latLng' => $center, 'popupContent' => $value['keterangan']]);
    $marker = new Marker([
        'name' => 'geoMarker',
        'latLng' => $center,
        'icon' => $makimarkers->make("star",['color' => "#b0b", 'size' => "m"]),
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
    'center' => $center,
    'zoom' => 13,
]);

// foreach ($dataProvider->getModels() as $key => $value) :

// $leaflet->addLayer($marker[$key]);

// endforeach;

// add the marker
$leafLet->addLayer($marker);

// install
$leafLet->installPlugin($makimarkers);

// install the plugin
$leafLet->installPlugin($geoCoderPlugin);

// run the widget (you can also use dosamigos\leaflet\widgets\Map::widget([...]))
echo $leafLet->widget([
    'options' => [
        'style' => 'height: 590px',]
]);