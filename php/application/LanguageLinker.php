<?php
require_once('application/XMLResourceBundle.php');
class LanguageLinker {
	public $resourceBundle;
	private $lang = "fr";
	
	public function __construct() {
		$this->loadBundle();
	}
	
	public function getLang() {
		return $this->lang;
	}
	
	public function setLang($lang) {
		$this->lang = $lang;
		$this->loadBundle();
	}
	
	private function loadBundle() {
		$this->resourceBundle = new XMLResourceBoundle("/Volumes/FILES/smeier/Sites/calendar/config/lang/", $this->lang);
	}
}
?>