<?php
require_once("model/bean/Person.php");
require_once("model/PersonModel.php");

$element = new Person(1, "Stefan", "Meier", "stefan.r.meier@unil.ch");
echo $element;
//$personModel = new PersonModel();
//echo (string) $personModel->add($element);

?>