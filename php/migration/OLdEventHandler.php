<?php
include_once("migration/OldEvent.php");
include_once("model/class/Db.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Event
 *
 * @author smeier
 */
class OldEventHandler {

    private $events;

    function __construct() {
        $sql = "SELECT E.id AS event_id,
                    uid AS owner,
                    recurrence_id,
                    edate AS E_Dbegin,
                    start_time AS E_Hbegin,
                    edate AS E_Dend,
                    end_time AS E_Hend,
                    title,
                    description,
                    R.id AS recurrence_id,
                    R.start AS recurrence_start,
                    R.end AS lastDate,
                    R.mode AS mode,
                    E.rooms_id AS room_id
                FROM events E
                     LEFT JOIN recurrences R
                         ON E.recurrence_id = R.id
                ";
        $db = new Db();
        $return = $db->select($sql);


        foreach ($return as $ret) {
            $id = $ret["event_id"];
            $uid = stripslashes($ret["owner"]);
            $title = stripslashes($ret["title"]);
            $description = stripslashes($ret["description"]);
            $date = $ret["E_Dbegin"];
            $start_time = $ret["E_Hbegin"];
            $end_time = $ret["E_Hend"];
            $repeat_mode = $ret["mode"];
            $repeat_end = $ret["lastDate"];
            $recurrence_id = $ret["recurrence_id"];
            $room_id = $ret["room_id"];


            $event = new OldEvent($uid, $title, $description, $date, $start_time, $end_time, $repeat_mode, $repeat_end, $id, $recurrence_id, $room_id);

            $this->events[] = $event;
        }

    }
    public function getEvents() {
        return $this->events;
    }





}

?>
