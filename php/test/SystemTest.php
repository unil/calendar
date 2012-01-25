<?php
session_start();
class SystemTest extends PHPUnit_Framework_TestCase
{	
	protected $auth;
	
	protected function setUp()
	{
		set_include_path("/Volumes/FILES/smeier/Sites/calendar/php");
		include_once("helpers/System.php");

		$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "student";
		$_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'] = "fbm-dpt-g";
		$this->auth = array(
						"read" => array(), 
						"write" => array(),
						"admin" => array(),
						"overwrite" => array(),
						"denyShibAttrib" => array());
	}

	public function testRead() {
		echo "\nread test\n";
		echo "\ntest with *\n";
		$this->auth["read"] = array("*");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
		
		echo  "\ntest with groupv";
		$this->auth["read"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
		
		echo "\ntest more groups\n";
		$this->auth["read"] = array("fbm-test", "toto", "fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);

		echo "\ntest empty\n";
		$this->auth["read"] = array();
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["read"]);
		
		echo "\ntest with studen attrib\n";
		$this->auth["denyShibAttrib"] = array("student");
		$this->auth["read"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["read"]);
		
		echo "\nwith affiliation different from denied attribut\n";
		$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "staff";
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
	}
	
	public function testWrite() {
		echo "\nwrite\n";
		echo "\ntest with *\n";
		$this->auth["write"] = array("*");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		echo "\ntest with group\n";
		$this->auth["write"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		echo "\ntest empty\n";
		$this->auth["write"] = array();
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["write"]);
		
		echo "\ntest with studen attrib\n";
		$this->auth["denyShibAttrib"] = array("student");
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["write"]);
				
		echo "\noverwrite is different from write\n";
		$this->auth["overwrite"] = array("fbm-dpt-test-g");
		$this->auth["write"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		echo "\noverwrite is specified but not write (inherit)\n";
		$this->auth["overwrite"] = array("fbm-dpt-g");
		$this->auth["write"] = array();
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
	}	
	
	public function testRoom() {	
		include_once("../../config/init.php");
		include_once("model/class/Room.php");
		include_once("model/RoomHandler.php");
		$_SERVER['HTTP_SHIB_CUSTOM_UNILMEMBEROF'] = "fbm-decanat-administration-secr-g";
		$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "staff";
		$roomHandler = new RoomHandler();
		$room = $roomHandler->getRooms(null, 53);
		
		$room = $room[0];
		
		$acl = $room->getAcl();
		$auth = System::auth($acl);
		$this->assertTrue($auth["write"]);
		//var_dump($acl);
		//var_dump($auth);
	}
}
?>