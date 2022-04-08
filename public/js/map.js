/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/map.js ***!
  \*****************************/
ymaps.ready(init);
var map = document.getElementById("map");
var longitude = map.dataset.longitude;
var latitude = map.dataset.latitude;
var zoom = map.dataset.zoom;

function init() {
  var myMap = new ymaps.Map("map", {
    center: [longitude, latitude],
    zoom: zoom
  }); // Создание геообъекта с типом точка (метка).

  var myGeoObject = new ymaps.GeoObject({
    geometry: {
      type: "Point",
      // тип геометрии - точка
      coordinates: [longitude, latitude] // координаты точки

    }
  }); // Размещение геообъекта на карте.

  myMap.geoObjects.add(myGeoObject);
}
/******/ })()
;