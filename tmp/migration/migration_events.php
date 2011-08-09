<?php

include_once("model/class/Event.php");
include_once("migration/OldEventHandler.php");
include_once("migration/OldEvent.php");

include_once("model/EventHandler.php");
include_once("model/class/DateCalc.php");
/*
 * ------------------------------------
 * Select old database and export events
 * ------------------------------------
 */
$_SESSION['DB_NAME'] = "calendar_old";
$oldEventHandler = new OldEventHandler();
$old_events = $oldEventHandler->getEvents();
$events_tmp = null;

$newevents = null;
$oldEventsNB = 0;
$newEventsNB = 0;

$recurrence_id = null;
$tmp_recurence_id = null;

/*
 * -------------------------
 * Select new database
 * -------------------------
 */
$_SESSION['DB_NAME'] = "calendar";

/*
 * ----------------------------------
 * Treat repeating event as one event
 * ----------------------------------
 */
$isFirst = true;
$recurrenceId_prev = null;
foreach ($old_events as $e) {
    $recurrence_id = $e->getRecurrence_id();
    if ($recurrenceId_prev === $recurrence_id) {
        $isFirst = false;
    } else {
        $recurrenceId_prev = $recurrence_id;
        $isFirst = true;
    }
    if ($isFirst) {
        $date = $e->getDate();
    }

    if ($e->getStart_time() == "55:55:55") {
        $e->setStart_time("00:00:00");
    }

    if ($e->getEnd_time() == "55:55:55") {
        $e->setEnd_time("00:00:00");
    }

    if ($recurrence_id != null) {
        $e->setDate($date);
        $events_tmp[$recurrence_id] = $e;
    } else {
        $events_tmp[] = $e;
    }
   $oldEventsNB++;
}
/*
 * -----------------------
 * Sort events per room
 * -----------------------
 */
foreach ($events_tmp as $e) {
    $newevents[$e->getRoom_Id()][] = $e;
}

/*
 * --------------------------
 * Import events into new system
 * --------------------------
 */

$eventHandler = new EventHandler();

foreach ($events_tmp as $ev) {
    $events = null;
    $room = new Room($ev->getRoom_id());
    $user = $ev->getUid();

    $event = new Event(
                    $ev->getId(),
                    $ev->getUid(),
                    $ev->getTitle(),
                    addslashes($ev->getDescription()),
                    $ev->getDate(),
                    $ev->getStart_time(),
                    $ev->getDate(),
                    $ev->getEnd_time(),
                    $ev->getRepeat_mode(),
                    null,
                    $ev->getRepeat_end()
    );

    if ($event->getMode() != "n" && $event->getMode() != null) {
        $dateCalc = new DateCalc($event->getDBegin(), $event->getLastDate(), $event->getMode());
        $dates = $dateCalc->repeatDate();
        foreach ($dates as $date) {
            $events[$date] = array("start" => $event->getHBegin(), "end" => $event->getHEnd());
        }
    } else {
        $events[$event->getDBegin()] = array("start" => $event->getHBegin(), "end" => $event->getHEnd());
    }

    $eventHandler->add($room, $event, $events);

    //to avoid the same primare key, let's sleep for 3 microseconds
    usleep(3);
    $newEventsNB++;
}

echo "Events exported from old system: $oldEventsNB<br/>";
echo "Events imported into new system: ". count($eventHandler->getEvents()) . " ($newEventsNB as DB)";

?>
