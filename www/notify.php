<?php
// -- get Datas
$lat = $_POST["lat"];
$lon = $_POST["lon"];
$uid = $_POST["uid"];
$mod = $_POST["mod"]; // QRC | NFC | DIR
$dat = date("Y-m-d H:i:s");

// -- get the user email
$usr_email = "default@domain.com";
$usr_name = "Julien";
$usr_bag = "bag 1";

// -- check HERE which bag is it
// -- HERE is a simple switch/case example but you can connect to and use your own database or a simple json file
switch($uid)
{
	case "UID0001":
		$usr_email = "user@domain.com";
		$usr_name = "Julien";
		$usr_bag = "bag 1";
		break;

	case "UID0002":
		$usr_email = "user2@domain.com";
		$usr_name = "Nico";
		$usr_bag = "bag 1";
		break;
}

// -- config
$sujet = "[Travel-loc] - scan notification";
$destinataire = $usr_email;
$expediteur = 'default@domain.com'; // USE YOUR OWN MAIL HERE

// -- message TEXT
$message_texte="";

// -- message HTML
$message_html="<html>
<head>
<title>Notification</title>
</head>
<body>
Scan notification for one of your Bag Tags.<br>
---<br>
<strong>UID :</strong> $uid<br>
<strong>User :</strong> $usr_name<br>
<strong>Bag :</strong> $usr_bag<br>
<strong>Date :</strong> $dat<br>
---<br>
<strong>Coordonn&eacute;es :</strong> $lat,$lon<br>
<a href='https://maps.google.com/?ll=$lat,$lon&t=m&z=18' target='_blank'>View on Maps</a><br>
---<br>
<strong>Mode :</strong> $mod
</body>
</html>";

// -- delimiter
$delimiter = '-----=' . md5( uniqid( mt_rand() ));

// -- header
$headers = 'From: "Travel-loc" <'.$expediteur.'>'."\n";
$headers .= 'Return-Path: <'.$expediteur.'>'."\n";
$headers .= 'MIME-Version: 1.0'."\n";
$headers .= 'Content-Type: multipart/mixed; boundary="'.$delimiter.'"';

// -- text message
$message = 'This is a multi-part message in MIME format.'."\n\n";
$message .= '--'.$delimiter."\n";
$message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
$message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
$message .= $message_texte."\n\n";

// -- html message
$message .= '--'.$delimiter."\n";
$message .= 'Content-Type: text/html; charset="iso-8859-1"'."\n";
$message .= 'Content-Transfer-Encoding: 8bit'."\n\n";
$message .= $message_html."\n\n";

// -- send the message and the feedback
if( mail( $destinataire, $sujet, $message, $headers ) ) echo '1';
else echo '0';

exit;
?>