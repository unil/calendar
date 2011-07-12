<?php

include_once("model/Calendar.php");
include_once("model/class/Room.php");
include_once("model/class/Event.php");
include_once("helpers/System.php");

//include_once("helpers/System.php");

class MonthCalendar extends Calendar {

    private $events;
    private $weekpos;
    private $maxDays;
    private $month;
    private $year;
    private $room;

    public function __construct($room, $month, $year) {
        if (!empty($month)) {
            $this->month = $month;
        }
        if (!empty($year)) {
            $this->year = $year;
        }
        $this->room = $room;

        $first = strtotime("{$year}-{$month}-01");
        $last = strtotime('-1 second', strtotime('+1 month', $first));


        $begin = date("Y-m-d", $first);
        $end = date("Y-m-d", $last);
        $this->maxDays = substr($end, 8, 2);

        parent::__construct($room, $begin, $end . " 23:59");

        $this->events = parent::getEvents();


        $this->weekpos = $this->getFirstDayOfMonthPosition($month, $year, parent::getWeekStart());
    }

    private function getFirstDayOfMonthPosition($month, $year, $weekstart) {
        $weekpos = date("w", mktime(0, 0, 0, $month, 1, $year));

        // adjust position if weekstart not Sunday
        if ($weekstart != 0) {
            if ($weekpos < $weekstart) {
                $weekpos = $weekpos + 7 - $weekstart;
            } else {
                $weekpos = $weekpos - $weekstart;
            }
        }
        return $weekpos;
    }

    public function getCalendarEvents() {
        return $this->events;
    }

    public function getCalendar() {
        $_SESSION['CURRENT_EVENTS'] = $this->events;
        $month_cal = "<table cellpadding=\"1\" cellspacing=\"1\" border=\"0\">\n";
        $currentDate = "";


        $month_cal .= parent::getHeader();

        $weekpos = $this->weekpos;

        $room = $this->room;
        $roomId = $room->getId();
        // get user permission level
        $auth = System::authLevel();
        // get number of days in month
        $days = $this->maxDays;
        $day = 0;
        // initialize day variable to zero, unless $weekpos is zero
        if ($weekpos == 0) {
            $day = 1;
        }
        // initialize today's date variables for color change
        $timestamp = time();
        $d = date('j', $timestamp);
        $m = date('n', $timestamp);
        $y = date('Y', $timestamp);

        // loop writes empty cells until it reaches position of 1st day of month ($wPos)
        // it writes the days, then fills the last row with empty cells after last day
        while ($day <= $days) {

            $month_cal .="\t<tr>\n";

            for ($i = 0; $i < 7; $i++) {

                if ($day > 0 && $day <= $days) {
                    $currentDate = $this->year . "-" . $this->month . "-" . $day;
                    $array_index = $day;
                    if ($array_index < 10) {
                        $array_index = "0" . (String)$day;
                    }
                    
                    $longMonth = $this->month;
                    if ($this->month < 10) {
                        $longMonth = "0" . (String)$this->month;
                    }
                    $currentDate = $this->year . "-" . $longMonth . "-" . $array_index;
                    
                    $month_cal .= "\t\t<td class=\"";

                    if (($day == $d) && ($this->month == $m) && ($this->year == $y)) {
                        $month_cal .= "today";
                    } else {
                        $month_cal .= "day";
                    }

                    $month_cal .= "_cell\">\n";


                    if ($auth > 0) {
                        $month_cal .= "\t\t<a class=\"psf\" id=\"$day-$roomId\" onClick=\"newEvent('$currentDate')\"><span class=\"day_number\">$day</span></a>\n";
                    } else {
                        $month_cal .= "$day";
                    }

                    $month_cal .= "\t\t<br />\n";

                    $events = null;

                    if (isset($this->events[$array_index])) {
                        $events = $this->events[$array_index];
                    }

                    //s'il existe au moins un événément pour ce jour
                    if ($events != null) {
                        $posY = 0;
                        $posX = $array_index;
                        foreach ($events as $e) {
                        	$begin = $e->getHBegin();
                        	$end = $e->getHEnd();
                        	if ($e->getHBegin() == "00:00" && $e->getHEnd() == "00:00") {
                        		$end = "24:00";
                        	}

                            $title = $e->getTitle();
                            $description = $e->getDescription();

                            $month_cal .= "\t\t<a class=\"psf\" onClick=\"editEvent('$posX', '$posY', '$currentDate')\">\n";

                            $month_cal .= "\t\t\t<span class=\"event_entry\">";
                            $month_cal .= "$begin - $end";
                            $month_cal .= "<br/>";

                            $month_cal .= "$title $description";
                            $month_cal .= "</span>\n";
                            $month_cal .= "\t\t</a><br>\n";
                            $posY++;
                        }
                    }

                    $month_cal .= "\t\t</td>\n";
                    $day++;
                } elseif ($day == 0) {
                    $month_cal .= "\t\t<td class=\"empty_day_cell\"><!--before--></td>\n";
                    $weekpos--;
                    if ($weekpos == 0) {
                        $day++;
                    }
                } else {
                    $month_cal .= "\t\t<td class=\"empty_day_cell\"><!--after--></td>\n";
                }
            }
            $month_cal .= "\t</tr>\n";
        }

        $month_cal .= "</table>\n";


        return $month_cal;
    }

}

?>
