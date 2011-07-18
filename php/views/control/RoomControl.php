<?php
require_once('application/GlobalRegistry.php');
require_once('application/LanguageLinker.php');
include_once("model/class/Building.php");
include_once("model/BuildingHandler.php");
include_once("model/RoomHandler.php");

session_start();

$globalRegistry = $_SESSION["GlobalRegistry"];
$languageLinker = $globalRegistry->languageLinker;


$rooms = null;
$buildings = null;


$buildingId = 27;

if (isset($_GET['id']) && $_GET['id'] != 'undefined') {
	$buildingId = (int) $_GET['id'];
}
$buildingHandler = new BuildingHandler();
$buildings = $buildingHandler->getBuildings();

$currentBuilding = null;

foreach ($buildings as $b) {
	if ($buildingId == $b->getId()) {
		$currentBuilding = $b;
	}
}
$_SESSION['CURRENT_BUILDING'] = $currentBuilding;
$roomHandler = new RoomHandler();
$rooms = $roomHandler->getRooms($currentBuilding);
?>
<div id="rooms">


<?php
if ($currentBuilding != null) {

	$room_sorted = null;
	foreach($rooms as $r) {
		$room_sorted[$r->getCategory()][] = array("id" => $r->getId(), "local" => $r->getLocal(), "name" => $r->getName());
	}

	echo "<ul>\n";
	foreach ($room_sorted as $key => $value) {
		$catgoryText =  $languageLinker->resourceBundle->get("room-category-". $key);

		echo "<li><a href=\"#\">$catgoryText</a>\n";
		echo "<ul>\n";
		foreach($value as $r) {
			echo "<li><a href=\"{$r["id"]}\" class=\"isClickable\">{$r["local"]} - {$r["name"]}</a></li>";
		}
		echo "</ul>\n";
		echo "</li>\n";

	}
	echo "</ul>\n";
}
?>
<!-- 
	<ul>
		<li><a href="#">Animalerie</a></li>
		<li><a href="#">Appareils scientifiques</a>
			<ul>
				<li><a href="#" class="isClickable">217 - Appareil de toto</a></li>
				<li><a href="#" class="isClickable">303 - Appareil X</a></li>
			</ul>
		</li>
		<li><a href="#">Salles</a>
			<ul>
				<li><a href="#" class="isClickable">105 - Salle de conférence</a></li>
				<li><a href="#" class="isClickable">219 - Salle de vidéconférence</a>
				</li>
			</ul>
		</li>
		<li><a href="#">Matériel de prêt</a></li>
	</ul> -->
</div>
