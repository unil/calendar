<?php
include_once("model/class/Room.php");
include_once("model/RoomHandler.php");
date_default_timezone_set('Europe/Zurich');
session_start();

$month = date("n");
$year = date("Y");
$roomId = 13;
$buildings = null;
$rooms = null;
$currentRoom = null;

if (isset($_GET['year']) && $_GET['year'] != 'undefined') {
    $year = (int) $_GET['year'];
}

if (isset($_GET['month']) && $_GET['month'] != 'undefined') {
    $month = (int) $_GET['month'];
}

if (isset($_GET['room']) && $_GET['room'] != 'undefined') {
    $roomId = (string) $_GET['room'];
}

$roomHandler = new RoomHandler();
$room = $roomHandler->getRooms(null, $roomId);
$room = $room[0];

$_SESSION['CURRENT_MONTH'] = $year;
$_SESSION['CURRENT_YEAR'] = $year;
$_SESSION['CURRENT_ROOM'] = $room;
$_SESSION['CURRENT_BUILDING'] = $building;
$_SESSION['ALL_BUILDINGS'] = $buildings;
$_SESSION['ALL_ROOMS'] = $rooms;
$_SESSION['EVENTS'] = $events;

?>
