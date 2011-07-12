<?php
/**
 * Contrôleur de l'application
 * @author Stefan Meier
 *
 * Version 20100817
 *
 */

date_default_timezone_set('Europe/Zurich');
session_start();
/* Toutes les réponses sont envoyées en UTF-8 */
header('Content-type: text/html; charset=UTF-8');

include 'config/init.php';
require_once('php/application/BootLoader.php');
BootLoader::init();

require("views/main.php");
?>