<?php
session_start();
date_default_timezone_set('Europe/Zurich');



/* Toutes les réponses sont envoyées en UTF-8 */
header('Content-type: text/html; charset=UTF-8');
include_once('config/init.php');
include_once("model/class/Room.php");
include_once("model/class/Event.php");
include_once("model/EventHandler.php");

$room = new Room("1");
$eventHandler = new EventHandler();
echo "<pre>";
$events = $eventHandler->getEvents($room, "2011-05-11", "2011-05-12");

foreach ($events as $e) {
    print_r($eventHandler->getSiblings($e));
}
echo "<pre />";


/* Si la session n'a pas encore été configurée, config/init.php sera chargé */

/*include 'config/init.php';

include_once("model/class/Db.php");
$db = new Db();


$sql = "SELECT * FROM events WHERE id=286";
echo "<pre>";
$return = $db->select($sql, false);
print_r($return);
$sql = "SELECT * FROM events WHERE id=287";
$return = $db->select($sql, false);
print_r($return);
$sql = "SELECT * FROM events WHERE id<=288";
$return = $db->select($sql);
print_r($return);
echo "</pre>";
/*foreach($db->select($sql) as $i) {

    echo $i["id"] . "<br />";
}*/
?>
