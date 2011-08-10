<?php

abstract class Element {
	private $id;

	public function __construct($id) {
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function __toString() {
		return $this->id;
	}
}

?>