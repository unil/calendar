<?php

//include_once("model/EventLogger.php");

date_default_timezone_set('Europe/Berlin');
include_once("model/class/Event.php");
include_once("controller/EventController.php");
include_once("helpers/System.php");
include_once("helpers/FormValidator.php");
include_once("model/class/DateCalc.php");

session_start();
$success = false;
$return = array("success" => true);

$auth = System::authLevel();

$salle = 0;
$valide = false;
$action = $_POST['action'];
$room = $_SESSION['CURRENT_ROOM'];
$user = $_SESSION['REMOTE_USER'];
$date = $_POST['edate'];
$name = $_POST['name'];
$start = $_POST['start_hour'] . ":" . $_POST['start_min'] . ":00";
$end = $_POST['end_hour'] . ":" . $_POST['end_min'] . ":00";
$description = $_POST['description'];

$wholeDay = false;
if (isset($_POST['whole_day'])) {
    $wholeDay = true;
}

//error check
if (System::authLevel() > 0) {
    if ($action == "delete" || $action == "edit" || $action == "add") {
        $formUser = $_POST['uid'];
        if (FormValidator::text($formUser, true) && $user == $formUser) {
            if ($action != "delete") {
                if (FormValidator::date($date)) {
                    if (strlen($name) > 0 && FormValidator::text($name, true)) {
                        if (strtotime($end) > strtotime($start) || $wholeDay == true) {
                        	if (FormValidator::text($description, true)) {
                        		$valide = true;
                        	}
                        	else {
                        		$return["success"] = false;
                        		$return["eventname"] = "eventname";
                        	}
                            
                        } else {
                            $return["success"] = false;
                            $return["time"] = "time";
                        }
                    } else {
                        $return["success"] = false;
                        $return["eventname"] = "eventname";
                    }
                } else {
                    $return["success"] = false;
                    $return["dateformat"] = "dateformat";
                }
            } else {
                $valide = true;
            }
        } else {
            $return["success"] = false;
            $return["auth"] = "user!=uid";
        }
    } else {
        $return["success"] = false;
        $return["action"] = $action;
    }
} else {
    $return["success"] = false;
    $return["aut"] = "permission";
}

//if no error
if ($valide) {
    $eventController = new EventController($room, $user);
    $formEvent = new Event(
                    $_POST['event_id'],
                    $_POST['uid'],
                    $name,
                    $description,
                    $date,
                    $start,
                    $date,
                    $end,
                    $_POST['repeat'],
                    $_POST['date_id'],
                    $_POST['repeat_end']
    );

    $modifyAll = $_POST["modifyall"];

    if ($modifyAll == 'true') {
        $modifyAll = true;
    } else if ($modifyAll == 'false') {
        $modifyAll = false;
    } else {
        $modifyAll = null;
    }

    $eventController = new EventController($room, $user);
    if ($action == "delete") {
        $eventController->setEvent($formEvent);
        if ($modifyAll) {
            $eventController->action("delete-all");
        } else {
            $eventController->action("delete-current");
        }
    } else {
        $insertAvailable = false;

        if (isset($_GET['insert-available']) && $_GET['insert-available'] == "true") {
            $insertAvailable = true;
        }

        $calculateDates = true;

        $events = null;
        $event = $formEvent;
        if ($action == "edit") {
            $originalEvent = new Event(
                            $_POST['event_id'],
                            $_POST['uid'],
                            $_POST['original_name'],
                            $_POST['original_description'],
                            $_POST['original_date'],
                            $_POST['original_start_time'],
                            $_POST['original_date'],
                            $_POST['original_end_time'],
                            $_POST['original_repeat_mode'],
                            $_POST['date_id'],
                            $_POST['original_repeat_end']);

            $name = $formEvent->getTitle();
            $date = $formEvent->getDBegin();
            $description = $formEvent->getDescription();


            if ($originalEvent->getDBegin() == $formEvent->getDBegin() &&
                    $originalEvent->getHBegin() == $formEvent->getHBegin() &&
                    $originalEvent->getHEnd() == $formEvent->getHEnd() &&
                    $originalEvent->getMode() == $formEvent->getMode() &&
                    $originalEvent->getLastDate() == $formEvent->getLastDate()) {

                $calculateDates = false;
            } else {
                $calculateDates = true;
            }

            $event->setDBegin($date);

            $event->setDEnd($date);
            $event->setTitle($name);
            $event->setDescription($description);
        }

        //calculate dates only if there was no error before and
        //if it is really necessary
        if ($calculateDates) {
            if ($event->getMode() == "n") {
                $events[$event->getDBegin()][] = array(
                    "start" => $event->getHBegin(),
                    "end" => $event->getHEnd(),
                    "id" => $event->getId());
                
               
            } else if ($event->getMode() == "a") {

            } else {
                $dateCalc = new DateCalc($event->getDBegin(), $event->getLastDate(), $event->getMode());
                $dates = $dateCalc->repeatDate();
                foreach ($dates as $date) {
                    $events[$date][] = array(
                        "start" => $event->getHBegin(),
                        "end" => $event->getHEnd(),
                        "id" => $event->getId());
                }
            }
            $eventController->setTimeTable($events);
        }
        $eventController->setEvent($event);
        $eventController->setInsertAvailable($insertAvailable);
        if ($action == "edit") {
            if ($calculateDates) {
                $eventController->action("update-all-withdate");
            } else {
                $eventController->action("update-all-nodate");
            }
            /*
              if ($modifyAll) {
              if ($calculateDates) {
              $eventController->action("update-all-withdate");
              } else {
              $eventController->action("update-all-nodate");
              }
              } else {
              if ($calculateDates) {
              $eventController->action("update-current-withdate");
              } else {
              $eventController->action("update-current-nodate");
              }
              } */
        } else {
            $eventController->action("add");
        }
        $return = $eventController->getReturn();
    }
}
echo json_encode($return);
?>
