/**
 * The MIT License
 * Copyright (c) 2013 jumahe (contact@jumahe.com) & nrauber (nrauber@gmail.com)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

var map;
var blueIconSrc = "http://gmaps-samples.googlecode.com/svn/trunk/markers/blue/blank.png";
var directionsDisplay;
var directionsService;

// -- INIT
function initialize()
{
    var myOptions = 
    {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // -- create map
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    
    // -- create direction display & service
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer( { markerOptions:{ visible:false } } );
    directionsDisplay.setMap(map);

    // -- pos
    var lat = "0";
    var lon = "0";

    // -- Try HTML5 geolocation
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition( function(position)
        {
            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            
            lat = position.coords.latitude + "";
            lon = position.coords.longitude + "";

            document.getElementById('lat1').innerHTML = lat;
            document.getElementById('lon1').innerHTML = lon;

            var mImg = new google.maps.MarkerImage(blueIconSrc);
            var usrMarker = new google.maps.Marker(
            {
                map:map,
                icon:mImg,
                position:pos
            });

            map.setCenter(pos);

            sendNotification(lat, lon, mod, uid);
        }, 
        function()
        {
            // -- Geolocation Fail
            handleNoGeolocation(true);
        });
    } 
    else 
    {
        // -- Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }
}

// -- send the notification
function sendNotification(thelat, thelon, themod, theuid)
{
    // -- change the path to notify.php
    $.post("http://www.yoursite.com/path/to/travel-loc/notify.php", { lat: thelat, lon: thelon, mod: themod, uid: theuid })
    .done( function(data) {
        alert("Data Loaded: " + data);
    })
    .fail( function() {
        alert("Error");
    });
}

// -- no geoloc error
function handleNoGeolocation(errorFlag) 
{
    var content = "---";
    
    if (errorFlag) content = 'FAIL';
    else content = 'Browser Error';
    
    var pos = new google.maps.LatLng(0, 0);
    
    displayInfo(pos, content);

    sendNotification("0", "0", mod, uid);
}

// -- display info
function displayInfo(pos, content)
{
    var options = {
        map: map,
        position: pos,
        content: content
    };
    
    var infowindow = new google.maps.InfoWindow(options);
    map.setCenter(options.position);
}

// -- load
google.maps.event.addDomListener(window, 'load', initialize); 