<?php

include_once("model/class/Db.php");
include_once("model/class/Building.php");

class BuildingHandler {

    public function getBuildings($id = null) {
        $db = new Db();
        $buildings = array();

        $sql_select = "SELECT
                    building_id AS id,
                    b.name AS b_name,
                    s.name AS s_name
                FROM buildings b, sites s 
        		WHERE s.site_id = b.site_id";
        $sql_orderby = " ORDER BY s.name, (b.name + 0)";

        $sql = $sql_select . $sql_orderby;

        $return = $db->select($sql);

        foreach ($return as $ret) {
            $building = new Building($ret["id"], $ret["s_name"] . " " .$ret["b_name"]);
            $buildings[] = $building;
        }

        return $buildings;
    }

}

?>
