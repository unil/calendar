<?php

abstract class Element {
	private $id;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
}

?>