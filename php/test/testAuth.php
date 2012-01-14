<?php
date_default_timezone_set('Europe/Zurich');
session_start();
/* Toutes les réponses sont envoyées en UTF-8 */
header('Content-type: text/html; charset=UTF-8');
header("Cache-Control: no-cache, must-revalidate");

include '../../config/init.php';
include_once("helpers/System.php");
include_once("model/class/Room.php");
include_once("model/RoomHandler.php");

$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "student";
$_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'] = "fbm-dgm-admin-g;fbm-dp-admin-g;fbm-dpt-admin-g;fbm-licr-admin-g;fbm-decanat-admin-g";


$roomHandler = new RoomHandler();
$room = $roomHandler->getRooms(null, 19);

$room = $room[0];
echo "<pre>";
print_r($room->getAcl());

print_r(System::auth($room->getAcl()));
echo "</pre>";


?>