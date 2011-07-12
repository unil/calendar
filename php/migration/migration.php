<?php
include_once('config/init.php');
header('Content-type: text/html; charset=UTF-8');
echo "<pre>";


echo "--------------<br/>";
echo "Rooms<br />";
echo "--------------<br/>";
echo "<br />";
include_once("migration/migration_rooms.php");
echo "<br /><br/>";


echo "--------------<br/>";
echo "Events<br />";
echo "--------------<br/>";
echo "<br />";
include_once("migration/migration_events.php");
echo "<br /><br/>";


echo "</pre>";
?>
