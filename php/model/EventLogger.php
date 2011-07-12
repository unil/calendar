<?php

include_once("helpers/Db.php");

class EventLogger {

    private $timestamp;
    private $action;
    private $uid;
    private $room_id;
    private $event_id;
    private $event_name;
    private $event_date;
    private $event_start;
    private $event_end;
    private $event_description;
    private $repeat_id;
    private $repeat_mode;
    private $repeat_end;

    function __construct($action, $uid, $room_id, $event_id, $event_name, $event_date, $event_start, $event_end, $event_description, $repeat_mode, $repeat_end) {
        $this->timestamp = strtotime("now");
        $this->action = $action;
        $this->uid = $uid;
        $this->room_id = $room_id;
        $this->event_id = $event_id;
        $this->event_name = $event_name;
        $this->event_date = $event_date;
        $this->event_start = $event_start;
        $this->event_end = $event_end;
        $this->event_description = $event_description;
        $this->repeat_mode = $repeat_mode;
        $this->repeat_end = $repeat_end;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getAction() {
        return $this->action;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getRoomid() {
        return $this->room_id;
    }

    public function getEventid() {
        return $this->event_id;
    }

    public function getEventname() {
        return $this->event_name;
    }

    public function getEventdate() {
        return $this->event_date;
    }

    public function getEventstart() {
        return $this->event_start;
    }

    public function getEventend() {
        return $this->event_end;
    }

    public function getEventdescription() {
        return $this->event_description;
    }

    public function getRepeatid() {
        return $this->repeat_id;
    }

    public function getRepeatmode() {
        return $this->repeat_mode;
    }

    public function getRepeatend() {
        return $this->repeat_end;
    }

    public function getSqldetails() {
        return $this->sql_details;
    }

    public function write() {
        $sql = "INSERT INTO logs (
            ldatetime,
            uid,
            action,
            rooms_id,
            event_id,
            event_name,
            event_date,
            event_start,
            event_end,
            event_description,
            repeat_mode,
            repeat_end) ";
        $sql .= "VALUES (
                '" . date("Y-m-d H:i:s", $this->timestamp) . "',
                '" . $this->uid . "',
                '" . $this->action . "',
                '" . $this->room_id . "',
                '" . $this->event_id . "',
                '" . $this->event_name . "',
                '" . $this->event_date . "',
                '" . $this->event_start . "',
                '" . $this->event_end . "',
                '" . $this->event_description . "',
                '" . $this->repeat_mode . "',
                '" . $this->repeat_end . "'
                    )";
        $connection = null;
        $query = null;
        $result = null;

        try {
            $connection = Db::open();
            mysql_query("SET NAMES 'utf8'");

            mysql_query($sql);

            Db::close();
        } catch (Exception $e) {
            ErrorHandler::throwException($e);
        }
    }

}

?>
