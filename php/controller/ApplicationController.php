<?php
require_once('application/GlobalRegistry.php');
require_once('application/LanguageLinker.php');
require_once("model/RoomHandler.php");
session_start();


$globalRegistry = $_SESSION["GlobalRegistry"];
$languageLinker = $globalRegistry->languageLinker;
$roomId = 13;

if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    $languageLinker->setLang($_GET['lang']);
}
if (isset($_GET['room']) && $_GET['room'] != 'undefined') {
	$roomId = (string) $_GET['room'];
	$roomHandler = new RoomHandler();
	$room = $roomHandler->getRooms(null, $roomId);
	$room = $room[0];
	$_SESSION['CURRENT_ROOM'] = $room;
}

?>
