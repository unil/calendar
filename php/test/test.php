<?php
date_default_timezone_set('Europe/Zurich');
session_start();
/* Toutes les réponses sont envoyées en UTF-8 */
header('Content-type: text/html; charset=UTF-8');
header("Cache-Control: no-cache, must-revalidate");

include '../../config/init.php';
include_once("helpers/System.php");
include_once("model/class/Room.php");
include_once("model/RoomHandler.php");

$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "staff";
$_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'] = "fbm-dgm-admin-g;fbm-dp-admin-g;ca-general-g;iafbm3-g;all-agendas-g;fbm-calendar-bu27-setups-g;ci-otrs-agents-g;fbm-admin-g;fbm-licr-g;unisciences-admin-g;tous-unil-autres-g;pat-fbm-g;fbm-si-g;ur_dpt_a-g;all-users-portail-g;mailbox-g;fbm-prog-inf-g;complice-g;fbm-micropolis-admin-g;rhea-all-g;fbm-decanat-g;personnel-unil-g;pat-unil-g;fbm-licr-admin-g;personnes-phys-g;acces-soft-g;eliot-g;tous-unil-g;bib-acces-portal-g;fbm-decanat-informatique-g;tous-fbm-g;acces-reseau-g;fbm-up-admin-g;portail-sap-g;tous-fbm-autres-g;rhea-app-g;intranet-g;membres-ur_unil-g;unilogo-g;iafbm1-g;rhea-main-g;fbm-decanat-admin-g;fbm-db-admin-g;fbm-db-g;fbm-dpt-admin-g;add-computer-to-ad-g;agenda-test-ci-g;fbm-informatique-g;fbm-dpt-informatique-g;cnlv-wwwdpt-g;jahia_redactors-g;fbm-dpt-g";


$roomHandler = new RoomHandler();
$room = $roomHandler->getRooms(null, 13);

$room = $room[0];
echo "<pre>";
print_r($room->getAcl());

print_r(System::auth($room->getAcl()));
echo "</pre>";


?>