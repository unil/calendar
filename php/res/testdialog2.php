<?php
session_start();

$mode = "add";
$disabled = false;
$title = "";
$edate = "";
$wholeDay = false;
$supprimer = false;
$startH = 0;
$startM = 0;
$endH = 0;
$endM = 0;
$repeatMode = "n";
$repeatEnd = "";
$description = "";
$recurrence_id = "";
$currentUser = $_SESSION['REMOTE_USER'];
$uid = "";
$date_id = "";
$event_id = "";


$disable = false;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>UNIL - FBM CALENDAR</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link type="text/css" rel="StyleSheet" href="https://wwwfbm.unil.ch/html/css/UNIL-FBM_default.css" />
        <link rel="stylesheet" type="text/css" href="html/css/default.css" />



        <link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />




    </head>
    <body>
        <div align="left">
            <div id="message"></div>
            <form id="eventform" name="eventform" action="/calendar/controller/event_controller.php" method="post">

                <div class="input text">
                    <input type="text" name="action" id="action" value="<?php echo $mode ?>" />
                    <input type="hidden" name="event_id" id="event_id" value="<?php echo $event_id ?>" />
                    <input type="hidden" name="date_id" id="date_id" value="<?php echo $date_id ?>" />
                    <input type="hidden" name="modifyall" id="modifyall" value="false" />

                    <label for="creator" id="event-user">Creator</label>
                    <input type="text" name="creator" id="creator" value="<?php echo $uid ?>" />

                    <!-- original entries, to know which part has been modified -->
                    <input type="hidden" name="original_name" id="original_name" value="<?php echo $title; ?>"/>
                    <input type="hidden" name="original_date" id="original_date" value="<?php echo $edate ?>" />
                    <input type="hidden" name="original_whole_day" id="original_whole_day" value="<?php echo $wholeDay; ?>"/>
                    <input type="hidden" name="original_start_time" id="original_start_hour" value="<?php echo "$startH:$startM:00"; ?>"/>
                    <input type="hidden" name="original_end_time" id="original_end_hour" value="<?php echo "$endH:$endM:00"; ?>"/>
                    <input type="hidden" name="original_repeat_mode" id="original_repeat_mode" value="<?php echo $repeatMode; ?>"/>
                    <input type="hidden" name="original_repeat_end" id="original_repeat_end" value="<?php echo $repeatEnd; ?>"/>
                    <input type="hidden" name="original_description" id="original_description" value="<?php echo $description; ?>"/>
                </div>
                <div class="input text">

                    <label for="name" id="event-title">Name</label>

                    <input type="text" name="name" id="name" class="required" value="<?php echo $title; ?>"/>
                    <input type="text" name="uid" id="uid" value="adsf"/>
                </div>
                <div class="input text">
                    <label for="edate" id="event-date">Date</label>
                    <input type="text" name="edate" id="edate" class="datepicker" value="<?php echo $edate ?>" />
                </div>
                <div class="input">
                    <label for="whole_day" id="event-whole-day">Jour entier</label>
                    <input type="checkbox" name="whole_day" id="whole_day" <?php echo ($wholeDay) ? "checked=\"checked\"" : ""; ?> />
                </div>
                <div class="input time" id="start">

                    <label for="start_hour" id="event-start">Début</label>

                    <select name="start_hour" id="start_hour">
                        <?php
                        for ($i = 0; $i <= 23; $i++) {
                            echo "<option";
                            if ($startH == $i) {
                                echo " selected";
                            }
                            echo ">";
                            if ($i < 10) {
                                echo "0";
                            }

                            echo $i . "</option>\n";
                        }
                        ?>
                    </select>
                    <span>:</span>
                    <select name="start_min" id="start_min">
                        <?php
                        for ($i = 0; $i < 60; $i += 5) {
                            echo "<option";
                            if ($startM == $i) {
                                echo " selected";
                            }
                            echo ">";
                            if ($i < 10) {
                                echo "0";
                            }

                            echo $i . "</option>\n";
                        }
                        ?>
                    </select>
                </div>

                <div class="input time" id="end">
                    <label for="end_hour" id="event-end">Fin</label>
                    <select name="end_hour" id="end_hour">
                        <?php
                        for ($i = 0; $i <= 23; $i++) {
                            echo "<option";
                            if ($endH == $i) {
                                echo " selected";
                            }
                            echo ">";
                            if ($i < 10) {
                                echo "0";
                            }

                            echo $i . "</option>\n";
                        }
                        ?>
                    </select>
                    <span>:</span>
                    <select name="end_min" id="end_min">
                        <?php
                        for ($i = 0; $i < 60; $i += 5) {
                            echo "<option";
                            if ($endM == $i) {
                                echo " selected";
                            }
                            echo ">";
                            if ($i < 10) {
                                echo "0";
                            }

                            echo $i . "</option>\n";
                        }
                        ?>
                    </select>
                </div>

                <div class="input select">
                    <label for="repeat" id="event-repeat">Répéter</label>
                    <select name="repeat" id="repeat">
                        <option <?php echo ($repeatMode == 'n') ? "selected=\"selected\"" : "" ?> value="n" id="repeat-n">Jamais</option>
                        <option <?php echo ($repeatMode == 'd') ? "selected=\"selected\"" : "" ?> value="d" id="repeat-d">Chaque jour</option>
                        <option <?php echo ($repeatMode == 'w') ? "selected=\"selected\"" : "" ?> value="w" id="repeat-w">Chaque semaine</option>
                        <option <?php echo ($repeatMode == '2w') ? "selected=\"selected\"" : "" ?> value="2w" id="repeat-2w">Toutes les deux semaines</option>
                        <option <?php echo ($repeatMode == 'm') ? "selected=\"selected\"" : "" ?> value="m" id="repeat-m">Chaque mois</option>
                        <option <?php echo ($repeatMode == 'y') ? "selected=\"selected\"" : "" ?> value="y" id="repeat-y">Chaque année</option>
                    </select>
                </div>
                <div class="input text" id="repeat_date">
                    <label for="repeat_end" id="repeat-until">Jusqu'à</label>
                    <input type="text" name="repeat_end" id="repeat_end" class="datepicker" value="<?php echo $repeatEnd ?>"/>
                </div>

                <div class="input textarea">
                    <label for="description" id="event-description">Description</label>
                    <textarea name="description" id="textarea" cols="20" rows="20"><?php echo $description ?></textarea>
                </div>
                <input type="submit" value="Envoyer" />
            </form>
        </div>
    </body>
</html>
<!-- END NEW EVENT DIALOG -->