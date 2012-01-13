<?php
require_once("controller/AbstractController.php");

class Controller extends AbstractController {

	private function getModel(Element $element, $modelKey) {
		$key = null;
		$model = null;
		
		try {
			$model = new $key;
			if ($this->models[$key]) {
				$model = $this->models[$key];
			}
			else {
				$model = new $key;
				$this->models[$key] = $model;
			}
		}
		catch (Exception $ex) {
			
		}
		
		return $model;
	}
}

?>