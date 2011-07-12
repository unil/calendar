<?php

require_once('php/application/GlobalRegistry.php');
require_once('php/application/LanguageLinker.php');
session_start();

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>UNIL - FBM CALENDAR</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link type="text/css" rel="StyleSheet" href="html/css/UNIL-FBM_default.css" />
        <link rel="stylesheet" type="text/css" href="html/css/default.css" />

    </head>
    <body>
    <?php 
    $globalRegistry = $_SESSION["GlobalRegistry"];
    
    
    $languageLinker = $globalRegistry->languageLinker;

    echo $languageLinker->getLang();
    ?>
    </body>
 </html>