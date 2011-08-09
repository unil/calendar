<?php

/**
 * Description of Event
 *
 * @author smeier
 */
class OldEvent {

    private $uid;
    private $title;
    private $description;
    private $date;
    private $start_time;
    private $end_time;
    private $repeat_mode;
    private $repeat_end;
    private $id;
    private $recurrence_id;
    private $room_id;

    function __construct($uid, $title, $description, $date, $start_time, $end_time, $repeat_mode, $repeat_end, $id, $recurrence_id, $room_id) {
        $this->uid = $uid;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->repeat_mode = $repeat_mode;
        $this->repeat_end = $repeat_end;
        $this->id = $id;
        $this->recurrence_id = $recurrence_id;
        $this->room_id = $room_id;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStart_time() {
        return $this->start_time;
    }

    public function getEnd_time() {
        return $this->end_time;
    }

    public function getRepeat_mode() {
        return $this->repeat_mode;
    }

    public function getRepeat_end() {
        return $this->repeat_end;
    }

    public function getId() {
        return $this->id;
    }

    public function getRecurrence_id() {
        return $this->recurrence_id;
    }

    public function getRoom_id() {
        return $this->room_id;
    }
    public function setStart_time($start_time) {
        $this->start_time = $start_time;
    }

    public function setEnd_time($end_time) {
        $this->end_time = $end_time;
    }
    public function setDate($date) {
        $this->date = $date;
    }



}

?>
