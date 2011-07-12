
<?php
date_default_timezone_set('Europe/Zurich');
include_once("model/MonthCalendar.php");
include_once("model/class/Room.php");
include_once("model/class/Building.php");
include_once("model/RoomHandler.php");
include_once("helpers/System.php");
session_start();



$month = date("n");
$year = date("Y");
$roomId = 13;

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

$calendar = new MonthCalendar($room, $month, $year);

$_SESSION['CURRENT_EVENTS'] = $calendar->getCalendarEvents();
$_SESSION['CURRENT_ROOM'] = $room;
$_SESSION['ADMIN'] = $room->getAdmins();
$_SESSION['SUPER_ADMIN'] = $room->getSuperAdmins();
$_SESSION['ACCEPT_STUDENTS'] = $room->getAcceptStudents();
$_SESSION['DB_LOGGING'] = $room->getIsLogged();


$building = $_SESSION['CURRENT_BUILDING'];
?>
<script type="text/javascript" src="html/js/calendar.js" ></script>

<div id="cal_agenda">
<?php
echo $calendar->getCalendar();
?>
</div>



<span id="cal_roomDescription">
<?php
echo $room->getDescription();
?>
</span>


<span id="cal_roomName"><?php echo $building->getName() . " - " . $room->getLocal() . " - " . $room->getName(); ?></span>