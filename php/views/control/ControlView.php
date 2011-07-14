<?php
require_once('application/GlobalRegistry.php');
require_once('application/LanguageLinker.php');
include_once("model/class/Building.php");
include_once("model/BuildingHandler.php");
include_once("model/RoomHandler.php");


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

<!-- BEGIN ROOM-SELECTOR -->
<div class="box">
	<h1>Chosir</h1>
	<div>
<!-- END CONTACT -->
<form name="roomChanger" id="roomChanger" action="">
    <?php
    echo "<select name=\"buildings\" id=\"buildings\">\n";

    foreach ($buildings as $b) {
        echo "<option value=\"" . $b->getId() . "\">" . $b->getName() . "</option>";
    }



    echo "</select>\n";

    echo "<select name=\"room\" id=\"room\">\n";
    echo "<option value=\"default\">---------------------------</option>";

    if ($currentBuilding != null) {
        
        $room_sorted = null;
        foreach($rooms as $r) {
            $room_sorted[$r->getCategory()][] = array("id" => $r->getId(), "local" => $r->getLocal(), "name" => $r->getName());
        }
        

        foreach ($room_sorted as $key => $value) {
        	$catgoryText =  $languageLinker->resourceBundle->get("room-category-". $key);
        	
            echo "<optgroup label=\"$catgoryText\">"; 
            foreach($value as $r) {
                echo "<option value=\"{$r["id"]}\">{$r["local"]} - {$r["name"]}</option>";
            //echo "<option value=\"{$r->getId()}\">{$r->getLocal()} - {$r->getName()} - {$r->getCategory()}</option>";
            }
            echo "</optgroup>";
        }
    }
    echo "</select>\n";
    ?>
</form>
</div>
<!-- END ROOM SELECTOR -->
</div>