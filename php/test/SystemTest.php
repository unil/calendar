<?php

class SystemTest extends PHPUnit_Framework_TestCase
{

	protected $acl;
	
	protected function setUp()
	{

		set_include_path("/Volumes/FILES/smeier/Sites/calendar/php");
		include_once("../../config/init.php");
		include_once("helpers/System.php");
		include_once("model/class/Room.php");
		include_once("model/RoomHandler.php");

		$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "student";
		$_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'] = "fbm-dgm-admin-g;fbm-dp-admin-g;fbm-dpt-admin-g;fbm-licr-admin-g;fbm-decanat-admin-g";
		
		/*$roomHandler = new RoomHandler();
		$room = $roomHandler->getRooms(null, 19);
		
		$room = $room[0];
		
		print_r($room->getAcl());*/
	}
	
	protected function tearDown()
	{
		
	}
	
	protected function t1() {
		$auth = array(
				"read" => array("*"), 
				"write" => array("fbm-calendar-bu27-animalerie-g", "fbm-dpt-g"),
				"admin" => array(),
				"overwrite" => array("fbm-dpt-admin-g"),
				"denyShibAttrib" => array());
		$this->acl = System::auth($auth);
	}
	
	protected function t2() {
		$auth = array(
				"read" => array("fbm-decanat-g"), 
				"write" => array(),
				"admin" => array(),
				"overwrite" => array("fbm-dpt-admin-g"),
				"denyShibAttrib" => array("student"));
		$this->acl = System::auth($auth);
	}
	
	protected function t3() {
		$auth = array(
					"read" => array("fbm-decanat-g"), 
					"write" => array(""),
					"admin" => array(""),
					"overwrite" => array(""),
					"denyShibAttrib" => array("student"));
		$this->acl = System::auth($auth);
	}
	
	public function testT1Write()
	{
		//print_r($room->getAcl());
		self::t1();
		
		$this->assertTrue($this->acl["write"]);
	}
	
	public function testT1Read() {
		self::t1();
		$this->assertTrue($this->acl["read"]);
	}
	
	public function testT1Overwrite() {
		self::t1();
		$this->assertTrue($this->acl["overwrite"]);
	}
	
	public function testT2Read() {
		self::t2();
		$this->assertFalse($this->acl["read"]);
	}
	
	public function testT2Write() {
		self::t2();
		$this->assertFalse($this->acl["write"]);
	}
	
	public function testBlank() {
		self::t3();
		$this->assertFalse($this->acl["write"]);
	}
	
}
?>