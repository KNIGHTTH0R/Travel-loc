<?php
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
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'DIR';
$mod_tech = "*direct access*";
switch( $mod )
{
    case "QRC":
        $mod_tech = "*QRCode Scan*";
        break;

    case "NFC":
        $mod_tech = "*NFC Scan*";
        break;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel-loc</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="global.css" type="text/css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Travel-loc</h1>
        <p>Thank you very much for having scanned my travel bag's ID<br>
        Please note my contact informations, give them with my luggage to the appropriate services around you (airport, hotel, ...) or please contact me directly.<br>
        <br>
        <!-- You can replace your personnal informations HERE or display variable informations depending on the UID -->
        YOUR NAME<br>
        YOUR ADDRESS<br>
        YOUR CITY - COUNTRY<br>
        YOUR PHONE NUMBER<br>
        YOUR EMAIL<br>
        <br>
        I already know that:<br>
        - you reached this page with: <?php echo $mod_tech; ?><br>
        - you are currently located HERE: lat:<span id="lat1">LAT</span>, lon:<span id="lon1">LON</span> (if geolocation is activated on your device)</p>
        <p><div id="map"></div></p>
        <p>Thank you very much.</p>

        <script type="text/javascript">
            var mod = "<?php echo $mod; ?>";
            var uid = "<?php echo isset($_GET['uid']) ? $_GET['uid'] : 'UIDXXXX'; ?>";
        </script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=true"></script>
        <script type="text/javascript" src="app.js"></script>

    </body>
</html>