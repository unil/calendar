<?php

if (isset($_GET['room']) && $_GET['room'] != 'undefined') {
	$roomId = (string) $_GET['room'];
	$roomHandler = new RoomHandler();
	$room = $roomHandler->getRooms(null, $roomId);
	$room = $room[0];
	$_SESSION['CURRENT_ROOM'] = $room;
}


?>