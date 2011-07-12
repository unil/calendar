<?php

session_start();
date_default_timezone_set('Europe/Zurich');

header('Content-type: text/html; charset=UTF-8');



include 'config/init.php';

include_once("model/class/Event.php");
include_once("model/EventHandler.php");
include_once("model/class/Room.php");
include_once("model/MonthCalendar.php");

$room = new Room(13);
$e = new EventHandler();

//$id, $owner, $title, $description, $dBegin, $hBegin, $dEnd, $hEnd, $mode, $dateId, $lastDate) {
//$event = new Event(0, "smeier6@unil.ch", "adsf", "", "2011-03-21", "15:00", "2011-03-21", "16:00", "n", "1234", "2011-03-10");

//$events[] = $event;
//print_r($events);
//$e->checkAvailability($room, $events);

//$events = $e->getEvents($room, '2011-03-10', '2011-03-29');

$date = "2011-02-28";
$begin = "15:00";
$end = "16:00";

$dates[$date][] = array("start" => $begin, "end" => $end);

$date = "2011-02-28";
$begin = "14:00";
$end = "14:30";

$dates[$date][] = array("start" => $begin, "end" => $end);

$date = "2011-02-27";
$begin = "14:00";
$end = "14:30";

$dates[$date][] = array("start" => $begin, "end" => $end);

echo "<pre>";
print_r($e->checkAvailability($room, $dates));
echo "</pre>";
//print_r($e->getEvents($room, '2010-2-28 16:22', '2010-2-28 17:00'));
/*print_r($events);
//print_r($e->getEvents($room, null, null, 1));


//comment faire pour différencer les événements par jour?
//array(annee(mois(jour()))

foreach ($events as $e) {
    echo $e->getId() . " ";


    $repeat = $e->getRepeat();

    echo $repeat["begin"];
    echo "<br />";
}
*/
//$cal = new MonthCalendar($room, 2, 2011);
//echo "</pre>";
//echo $cal->getCalendar();

?>