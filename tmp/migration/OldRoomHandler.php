<?php

include_once("migration/OldRoom.php");
include_once("model/class/Db.php");

class OldRoomHandler {

    private $rooms;

    function __construct() {

        /*
         *   `id` int(9) NOT NULL AUTO_INCREMENT,
  `building_id` int(9) NOT NULL,
  `local` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `admin` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fbm-admin-g',
  `super_admin` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fbm-admin-g',
  `accept_students` int(1) NOT NULL DEFAULT '1',
  `monitoring` int(1) NOT NULL DEFAULT '0',
  `maxConn` int(1) NOT NULL DEFAULT '0',
         */

        $sql = "SELECT 
                            id,
                            building_id,
                            description,
                            name,
                            local,
                            admin,
                            super_admin,
                            accept_students,
                            monitoring
                        FROM rooms 
                        ORDER BY id";

        $db = new Db();
        $return = $db->select($sql);


        foreach ($return as $ret) {
            $id = $ret["id"];
            $building_id = $ret["building_id"];
            $local = $ret["local"];
            $description = stripslashes($ret["description"]);
            $name = $ret["name"];
            $admin = $ret["admin"];
            $super_admin = $ret["super_admin"];
            $accept_students = $ret["accept_students"];
            $monitoring = $ret["monitoring"];

            $room = new OldRoom($id, $building_id, $local, $name, $description, $admin, $super_admin, $accept_students, $monitoring);

            $this->rooms[] = $room;
        }
    }

    public function getRooms() {
        return $this->rooms;
    }

}

?>
