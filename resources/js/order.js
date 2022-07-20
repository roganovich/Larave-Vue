import 'bs5-lightbox'

ymaps.ready(init);

var points = document.getElementById("map");

var longitude = points.dataset.longitude;
var latitude = points.dataset.latitude;
var zoom = points.dataset.zoom;
var map_points = points.dataset.points;


function init(){
    var myMap = new ymaps.Map("map", {
        center: [longitude , latitude],
        zoom: zoom
    })

    var myGeoObjects = [];

    var point_array = JSON.parse(map_points);
    console.log(point_array);
    for (var i = 0; i < point_array.length; i++) {
        myGeoObjects = new ymaps.GeoObject({
            geometry: {
                type: "Point",
                coordinates: point_array[i]
            },
            properties: {
                balloonContentBody: 'Текст балуна № '+(i+1)
            }
        });
        myMap.geoObjects.add(myGeoObjects);
    }

    function changeMap(longitude, latitude, zoom){
        myMap.setCenter([longitude, latitude]);
        myMap.setZoom(zoom);
    }

    var select_point = document.querySelectorAll('input[type=radio][name="point_id"]');
    select_point.forEach(select_point => select_point.addEventListener('change', () => {

        var longitude = select_point.dataset.longitude;
        var latitude = select_point.dataset.latitude;
        var zoom = select_point.dataset.zoom;
        console.log('select_point', longitude, latitude, zoom);
        changeMap(longitude, latitude, zoom);
    }));
}


