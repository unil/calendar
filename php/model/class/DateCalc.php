<?php

/**
 * Description of DateCalc
 *
 * @author smeier
 */
date_default_timezone_set('Europe/Zurich');
class DateCalc {

    private $start;
    private $end;
    private $mode;

    function __construct($start, $end, $mode) {
        $this->start = $start;
        $this->end = $end;
        $this->mode = $mode;
    }

    public function diffDate() {
        $datetime1 = new DateTime($this->start);
        $datetime2 = new DateTime($this->end);

        $interval = $datetime1->diff($datetime2, true);

        $y = (int) $interval->format('%y');
        $m = (int) $interval->format('%m');
        $d = (int) $interval->format('%a');
        $w = (int) ($d / 7);

        $diff = 0;

        switch ($this->mode) {
            case 'd' :
                $diff = $d;
                break;
            case 'w' :
                $diff = $w;
                break;
            case '2w' :
                $diff = (int) ($w / 2);
                break;
            case 'm' :
                $diff = $m + (12 * $y);
                break;
            case 'y' :
                $diff = $y;
                break;
        }
        return $diff;
    }

    public function repeatDate() {

        $weekday = date('l', strtotime($this->start));

        (array) $result = null;

        switch ($this->mode) {
            case "d" :
                $offset = "tomorrow ";
                break;
            case "w" :
                $offset = "next " . $weekday;
                break;
            case "2w" :
                $offset = "next " . $weekday . "+1 week";
                break;
            case "m" :
                $offset = "next " . $weekday . "+3 week";
                break;
            case "y" :
                $offset = "next " . $weekday . "+51 week";
                ;
                break;
        }

        $counter_end = $this->diffDate();

        $date_c = $this->start;


        for ($i = 0; $i <= $counter_end; $i++) {
            $result[$i] = $date_c;
            $year = (int) substr($date_c, 0, 4);
            $month = (int) substr($date_c, 5, 2);
            $day = (int) substr($date_c, 8, 2);

            $timestamp = mktime(0, 0, 0, $month, $day, $year);
            $date_c = (string) date("Y-m-d", strtotime($offset, $timestamp));
            
        }
        return $result;
    }

}

?>
