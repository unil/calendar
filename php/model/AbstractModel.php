<?php
abstract class AbstractModel {
	abstract function get($params = null);
	abstract function add(Element $element);
	abstract function edit(Element $element);
	abstract function remove(Element $element);	
}
?>