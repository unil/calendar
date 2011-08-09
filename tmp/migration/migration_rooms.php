<?php
include_once("model/class/Room.php");
include_once("migration/OldRoom.php");
include_once("migration/OldRoomHandler.php");

include_once("model/class/Room.php");
include_once("model/RoomHandler.php");


/*
 * ------------------------------------
 * Select old database and export rooms
 * ------------------------------------
 */
$_SESSION['DB_NAME'] = "calendar_old";
$oldRoomHandler = new OldRoomHandler();
$oldRooms = $oldRoomHandler->getRooms();

$_SESSION['DB_NAME'] = "calendar";
$newRoomHandler = new RoomHandler();
$newRooms = null;

$oldRoomsNB = 0;


foreach ($oldRooms as $r) {
    $room = new Room(
            $r->getId(),
            addslashes($r->getDescription()),
            $r->getName(),
            "",
            $r->getBuilding_id(),
            $r->getLocal(),
            $r->getAdmin(),
            $r->getSuper_admin(),
            $r->getAccept_students(),
            0,
            1);
    $newRooms[] = $room;
    $oldRoomsNB++;
}

foreach($newRooms as $r) {
    $newRoomHandler->add($r);
    usleep(3);
}

echo "Rooms exported from old system: $oldRoomsNB<br/>";
echo "Rooms imported into new system: ". count($newRoomHandler->getRooms());
?>
