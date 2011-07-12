<?php
date_default_timezone_set('Europe/Berlin');

class FormValidator {

	public static function email($email) {
		$reg = "#^[^-_\.][a-z0-9-_\.]+[^-_\.]@[^-_\.][a-z0-9-_\.]+[^-_\.]\.[a-z]{2,4}$#";

		return preg_match($reg, $email);
	}

	public static function text($text, $asString) {		
		$ret = true;
		 
		if (strlen($text) > 0) {
			$actual_length = strlen($text);
			$stripped_length = strlen(strip_tags($text));
			if($actual_length != $stripped_length) {
				$ret = false;
			}
		}		 
		return $ret;
	}

	public static function date($date) {
		$date_s = strtotime($date);

		$year = date("Y", $date_s);
		$month = date("n", $date_s);
		$day = date("j", $date_s);

		return checkdate($month, $day, $year);
	}
}
?>
