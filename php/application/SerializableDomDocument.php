<?php
class SerializableDomDocument extends DomDocument {

 private $_xml;


 public function __sleep() {
  $this->_xml = $this->saveXML();
  return array('_xml');
 }

 public function __wakeup() {
  $this->loadXML( $this->_xml );
 }
}
?>