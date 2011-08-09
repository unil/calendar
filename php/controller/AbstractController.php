<?php

abstract class AbstractController {
	protected $models = null;
	
	/**/
	abstract function get($filter = null);
	abstract function save($elements);
}

?>