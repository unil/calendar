<?php
require_once('application/GlobalRegistry.php');
require_once("application/LanguageLinker.php");

class BootLoader {
	
	public static function init() {
		$globalRegistry = new GlobalRegistry();
		$globalRegistry->config = parse_ini_file("config/application.ini");
		$globalRegistry->languageLinker = new LanguageLinker();
		
		$_SESSION["GlobalRegistry"] = $globalRegistry;
	}
}

?>