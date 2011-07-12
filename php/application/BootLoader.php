<?php
require_once('application/GlobalRegistry.php');
require_once("application/LanguageLinker.php");

class BootLoader {
	public static function init() {
		$globalRegistry = new GlobalRegistry();
		$globalRegistry->languageLinker = new LanguageLinker();
		
		$_SESSION["GlobalRegistry"] = $globalRegistry;
	}
}

?>