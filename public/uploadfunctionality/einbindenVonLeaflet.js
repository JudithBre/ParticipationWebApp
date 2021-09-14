//****various jshint configs****
// jshint esversion: 8
// jshint browser: true
// jshint node: true
// jshint -W117
// jshint -W083
"use strict";

const lat = 51.968185447063746;
const lon = 7.596422955590237;

const start_latlng = [lat, lon];

let map = L.map("map", {
  center: start_latlng,
  zoom: 17
});

let marker1 = L.marker([51.96784585567931, 7.596464252259507]).addTo(map)
.bindPopup('Marker 1'),
 marker2 = L.marker([51.967875824358856, 7.596282949194921]).addTo(map)
.bindPopup('Marker 2'),
 marker3 = L.marker([51.968185447063746, 7.596422955590237]).addTo(map)
.bindPopup('Marker 3'),
 marker4 = L.marker([51.9686147392282, 7.596396925911135]).addTo(map)
.bindPopup('Marker 4');

var dreiecksstaender1 = L.layerGroup([marker1]);
var dreiecksstaender2 = L.layerGroup([marker2]);
var dreiecksstaender3 = L.layerGroup([marker3]);
var dreiecksstaender4 = L.layerGroup([marker4]);

let osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution: "Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors"
}).addTo(map);

var OpenStreetMap = {
  "Open Street Map": osm
};
var Standorte = {
    "Standort 1": dreiecksstaender1,
    "Standort 2": dreiecksstaender2,
    "Standort 3": dreiecksstaender3,
    "Standort 4": dreiecksstaender4
};

L.control.layers(OpenStreetMap, Standorte).addTo(map);
