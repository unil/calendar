<?php
require_once('application/GlobalRegistry.php');
require_once('application/LanguageLinker.php');
session_start();


$globalRegistry = $_SESSION["GlobalRegistry"];
$languageLinker = $globalRegistry->languageLinker;

if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    $languageLinker->setLang($_GET['lang']);
}
?>
