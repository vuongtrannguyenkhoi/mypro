$(document).ready(function () {

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
/* google */
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
    function googleMap(id,title,p1,p2){
        var map_canvas = document.getElementById(id);

        var map_options = {
            center: new google.maps.LatLng(p1, p2),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var map = new google.maps.Map(map_canvas, map_options);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(p1, p2),
            map: map,
            title: title
        });
        var styles = [
            {
                "featureType": "landscape",
                "stylers": [
                    { "visibility": "on" },
                    { "color": "#282828" }
                ]
            },{
                "featureType": "poi",
                "stylers": [
                    { "visibility": "off" }
                ]
            },{
                "featureType": "road",
                "stylers": [
                    { "color": "#383838" }
                ]
            },{
                "elementType": "geometry.stroke",
                "stylers": [
                    { "visibility": "off" }
                ]
            },{
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [
                    { "visibility": "on" },
                    { "weight": 8 },
                    { "hue": "#ff0000" },
                    { "color": "#ffffff" }
                ]
            },{
                "featureType": "landscape",
                "elementType": "labels.text.stroke",
                "stylers": [
                    { "color": "#ffffff" },
                    { "visibility": "on" }
                ]
            },{
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [
                    { "visibility": "on" }
                ]
            },{
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    { "visibility": "off" },
                    { "color": "#ffffff" }
                ]
            },{
                "featureType": "water",
                "elementType": "labels.text.stroke",
                "stylers": [
                    { "visibility": "on" },
                    { "color": "#ffffff" }
                ]
            },{
                "featureType": "water",
                "stylers": [
                    { "color": "#004044" }
                ]
            },{
            }
        ];
        // Grey Scale
        var greyscale_style = [{
            "featureType" : "road.highway",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "landscape",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "transit",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "poi",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "poi.park",
            "stylers" : [{
                "visibility" : "on"
            }]
        }, {
            "featureType" : "poi.park",
            "elementType" : "labels",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "poi.park",
            "elementType" : "geometry.fill",
            "stylers" : [{
                "color" : "#d3d3d3"
            }, {
                "visibility" : "on"
            }]
        }, {
            "featureType" : "poi.medical",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "poi.medical",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "road",
            "elementType" : "geometry.stroke",
            "stylers" : [{
                "color" : "#cccccc"
            }]
        }, {
            "featureType" : "water",
            "elementType" : "geometry.fill",
            "stylers" : [{
                "visibility" : "on"
            }, {
                "color" : "#cecece"
            }]
        }, {
            "featureType" : "road.local",
            "elementType" : "labels.text.fill",
            "stylers" : [{
                "visibility" : "on"
            }, {
                "color" : "#808080"
            }]
        }, {
            "featureType" : "administrative",
            "elementType" : "labels.text.fill",
            "stylers" : [{
                "visibility" : "on"
            }, {
                "color" : "#808080"
            }]
        }, {
            "featureType" : "road",
            "elementType" : "geometry.fill",
            "stylers" : [{
                "visibility" : "on"
            }, {
                "color" : "#fdfdfd"
            }]
        }, {
            "featureType" : "road",
            "elementType" : "labels.icon",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "water",
            "elementType" : "labels",
            "stylers" : [{
                "visibility" : "off"
            }]
        }, {
            "featureType" : "poi",
            "elementType" : "geometry.fill",
            "stylers" : [{
                "color" : "#d2d2d2"
            }]
        }];

        map.setOptions({styles: greyscale_style});
    }
function initialize() {
    googleMap('googleMap','Topaz city Quận 8',10.738918,106.680378);
    googleMap('googleMapEciland','Eciland Group',10.780408,106.684235);
}
google.maps.event.addDomListener(window, 'load', initialize);


});