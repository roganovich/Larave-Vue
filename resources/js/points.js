import 'bs5-lightbox'


ymaps.ready(init);

var points = document.getElementById("map");

var longitude = points.dataset.longitude;
var latitude = points.dataset.latitude;
var zoom = points.dataset.zoom;

function init(){
    var myMap = new ymaps.Map("map", {
        center: [longitude , latitude],
        zoom: zoom
    })

    // Создание геообъекта с типом точка (метка).
    var myGeoObject = new ymaps.GeoObject({
        geometry: {
            type: "Point", // тип геометрии - точка
            coordinates: [longitude, latitude] // координаты точки
        }
    });

    // Размещение геообъекта на карте.
    myMap.geoObjects.add(myGeoObject);

}
