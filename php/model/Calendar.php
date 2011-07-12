<?php

date_default_timezone_set('Europe/Zurich');
/**
 * Description of Calendar
 *
 * @author smeier
 */
include_once("helpers/ErrorHandler.php");
include_once("model/class/Db.php");
include_once("helpers/System.php");


include_once("model/EventHandler.php");
include_once("model/class/Room.php");

abstract class Calendar {

    private $room;
    private $begin;
    private $end;
    private $weekstart;

    public function __construct($room, $begin, $end) {
        $this->room = $room;
        $this->begin = $begin;
        $this->end = $end;
        $this->weekstart = 1;
    }

    public function getEvents() {
        $eventHandler = new EventHandler();
        $formattedEvents = array();

        $events = $eventHandler->getEvents($this->room, $this->begin, $this->end);

        foreach ($events as $e) {
            $date = explode("-", $e->getDbegin());
            $formattedEvents[$date[2]][] = $e;
        }

        return $formattedEvents;
    }

    public function getHeader() {
        $s = "";

        for ($i = 1; $i <= 7; $i++) {
            $s .= "\t<td class=\"column_header\" id=\"day" . $i . "\">&nbsp;</td>\n";
        }

        return $s;
    }

    public function getWeekStart() {
        return $this->weekstart;
    }

    abstract function getCalendar();

    abstract function getCalendarEvents();
}

?>
