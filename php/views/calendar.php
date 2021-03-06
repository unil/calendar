
<?php
date_default_timezone_set('Europe/Zurich');
require_once('application/GlobalRegistry.php');
require_once('application/LanguageLinker.php');
include_once("model/MonthCalendar.php");
include_once("model/class/Room.php");
include_once("model/class/Building.php");
include_once("model/RoomHandler.php");
include_once("model/BuildingHandler.php");
session_start();

include_once("helpers/System.php");
$globalRegistry = $_SESSION["GlobalRegistry"];
$languageLinker = $globalRegistry->languageLinker;

$month = date("n");
$year = date("Y");
$roomId = 13;
$buildingId = 27;

if (isset($_GET['year']) && $_GET['year'] != 'undefined') {
	$year = (int) $_GET['year'];
}

if (isset($_GET['month']) && $_GET['month'] != 'undefined') {
	$month = (int) $_GET['month'];
}

if (isset($_GET['room']) && $_GET['room'] != 'undefined') {
	$roomId = (string) $_GET['room'];
}
if (isset($_GET['building']) && $_GET['building'] != 'undefined') {
	$buildingId = (int) $_GET['building'];
}
$building = null;
if (isset($_SESSION['CURRENT_BUILDING'])) {
	$building = $_SESSION['CURRENT_BUILDING'];
}
else {
	$buildingHandler = new BuildingHandler();
	$buildings = $buildingHandler->getBuildings();

	foreach ($buildings as $b) {
		if ($buildingId == $b->getId()) {
			$building = $b;
		}
	}
}


$roomHandler = new RoomHandler();
$room = $roomHandler->getRooms(null, $roomId);

$room = $room[0];
$_SESSION['ACL'] = System::auth($room->getAcl());
$calendar = new MonthCalendar($room, $month, $year);

$_SESSION['CURRENT_EVENTS'] = $calendar->getCalendarEvents();
$_SESSION['CURRENT_ROOM'] = $room;

$_SESSION['DB_LOGGING'] = $room->getIsLogged();


?>
<script type="text/javascript" src="html/js/calendar.js" ></script>

<div id="cal_agenda">
<?php
if ($_SESSION["ACL"]["read"]) {
	echo $calendar->getCalendar();
}
else {
	echo "<div style=\"padding: 6px\">";
	echo $languageLinker->resourceBundle->get("calendar-error-aclReadCalendar");

	if (@!$_SERVER['HTTP_SHIB_PERSON_UID']) {
		echo "<br /> {$languageLinker->resourceBundle->get("calendar-error-login")}";
	}
	echo "</div>";
}
?>
</div>



<span id="cal_roomDescription">
<?php
$description = $room->getDescription();
echo $description;
if (strlen($description) > 0) {
	echo "<br /><br />";
}
echo "{$languageLinker->resourceBundle->get("calendar-message-checkAvailability")}: ";
$maxEvents = $room->getMaxEvents();
if ($maxEvents > 0) {

	echo $languageLinker->resourceBundle->get("calendar-message-confirm-button-yes");
}else {
	echo $languageLinker->resourceBundle->get("calendar-message-confirm-button-no");
}?>
</span>


<span id="cal_roomName"><?php echo $building->getName() . " - " . $room->getLocal() . " - " . $room->getName(); ?></span>