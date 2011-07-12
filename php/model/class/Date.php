<?php

class Date {

    public static function lastday($month, $year) {
        if (empty($month)) {
            $month = date('m');
        }
        if (empty($year)) {
            $year = date('Y');
        }
        $result = strtotime("{$year}-{$month}-01");
        $result = strtotime('-1 second', strtotime('+1 month', $result));
        return date('d', $result);
    }

    public static function getToday() {

        $timestamp = time();
        $d = date('j', $timestamp);
        $m = date('n', $timestamp);
        $y = date('Y', $timestamp);

        $today = array("y" => $y, "m" => $m, "d" => $day);

        return $today;
    }

}

?>
