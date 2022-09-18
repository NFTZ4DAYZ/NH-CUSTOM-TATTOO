"use strict";

var mapData = config.gmap;

/*----------------------------------------------------------------------------*/
/*      Detect the browser
/*----------------------------------------------------------------------------*/

function isMobile() {
    return (/(iPhone|iPod|iPad|BlackBerry|Android)/.test(navigator.userAgent));
}

/*----------------------------------------------------------------------------*/
/*      Function to create your custom Google Map
/*----------------------------------------------------------------------------*/

function init() {

        // Google Map options
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions

    var mapOptions = {
            draggable               : isMobile() ? false : true,
            streetViewControl       : false,
            disableDoubleClickZoom  : true,
            scrollwheel             : false,
            zoom                    : mapData.zoom,
            center                  : new google.maps.LatLng(mapData.latitude,mapData.longitude),
            styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"administrative.locality","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#cfc8be"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cfc8be"},{"visibility":"on"}]}]
        },

        // Create the Google Map using the map container and options defined above
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
      
        var marker = new google.maps.Marker({
            position    : mapOptions.center,
            map         : map,
            icon        : mapData.marker
        });

}

/*----------------------------------------------------------------------------*/
/*      When the window has finished loading create your Google Map
/*----------------------------------------------------------------------------*/
google.maps.event.addDomListener(window, 'load', init);