<?php

include_once("model/class/Db.php");
include_once("model/class/Building.php");
include_once("model/class/Room.php");

class RoomHandler {

	public function getRooms($building = null, $roomId = null) {
		$db = new Db();
		$rooms = array();


		$sql_select = "SELECT
                            r.room_id,
                            building_id,
                            rc.name AS category,
                            description,
                            r.name,
                            local,
                            manager,
                            ra.read,
                            ra.write,
                            ra.overwrite,
                            ra.admin
                            ra.denyShibAttrib,
                            monitoring,
                            maxEvents
                FROM rooms r, room_categories rc
                WHERE r.room_category_id = rc.room_category_id AND r.room_id = ra.room_id";
		if ($building != null) {
			$sql_select .= " AND building_id = " . $building->getId() . " ";
		} else if ($roomId != null) {
			$sql_select .= " AND room_id = " . $roomId . " ";
		}
		$sql_orderby = "ORDER BY local, r.name";

		$sql = $sql_select . $sql_orderby;

		$return = $db->select($sql);



		foreach ($return as $ret) {
			$id = $ret["room_id"];
			$building_id = $ret["building_id"];
			$category = $ret["category"];
			$name = $ret["name"];
			$description = $ret["description"];
			$local = $ret["local"];
			$manager = $ret["manager"];
			$aclRead = explode(";", $ret["read"]);
			$aclWrite = explode(";", $ret["write"]);
			$aclOverwrite = explode(";", $ret["overwrite"]);
			$aclAdmin = explode(";", $ret["admin"]);
			$aclDenyShibAttrib = explode(";", $ret["aclDenyShibAttrib"]);
			
			$acl = array("read" => $aclRead, "write" => $aclWrite,
						"overwrite" => $aclOverwrite, "admin" => $aclAdmin,
						"denyShibAttrib" => $aclDenyShibAttrib);

			$monitoring = $ret["monitoring"];
			$maxEvents = $ret["maxEvents"];

			$room = new Room($id, $description, $name, $manager, $building_id, $local, $acl, $monitoring, $maxEvents, $category);
			$rooms[] = $room;
		}

		return $rooms;
	}
/*
	public function add($room) {
		$success = true;

		$sql = "INSERT INTO rooms (";

		if ($room->getId() != null && $room->getId() >= 1) {
			$sql.= "room_id,";
		}

		$sql.= "
                building_id,
                local,
                name,
                manager,
                description,
                admins,
                superAdmins,
                acceptStudents,
                monitoring,
                maxEvents) ";
		$sql .= "
                VALUES ";
		$sql .= "(";
		if ($room->getId() != null && $room->getId() >= 1) {
			$sql .= $room->getId();
			$sql .= ", ";
		}
		$sql .= "'" . $room->getBuilding() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getLocal() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getName() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getManager() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getDescription() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getAdmins() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getSuperAdmins() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getAcceptStudents() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getIsLogged() . "'";
		$sql .= ", ";
		$sql .= "'" . $room->getMaxEvents() . "'";
		$sql .= ");";

		$db = new Db();
		$db->insert($sql);

		return $success;
	}
*/
}

?>
