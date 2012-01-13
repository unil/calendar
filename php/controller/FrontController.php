<?php

class FrontController {

	private $controller = null;
	private $action = null;
	
	public function __construct() {
		foreach ($_REQUEST as $key => $value) {
			echo "key: $key; value: $value<br/>";
		}
	}
}

?>