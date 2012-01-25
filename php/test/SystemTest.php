<?php

class SystemTest extends PHPUnit_Framework_TestCase
{	
	protected $auth;
	
	protected function setUp()
	{
		set_include_path("/Volumes/FILES/smeier/Sites/calendar/php");
		include_once("../../config/init.php");
		include_once("helpers/System.php");
		include_once("model/class/Room.php");
		include_once("model/RoomHandler.php");


		/*$roomHandler = new RoomHandler();
		$room = $roomHandler->getRooms(null, 19);
		
		$room = $room[0];
		
		print_r($room->getAcl());*/
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
		echo "read test";
		echo "test with *";
		$this->auth["read"] = array("*");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
		
		echo  "test with group";
		$this->auth["read"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
		
		echo "test more groups";
		$this->auth["read"] = array("fbm-test", "toto", "fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);

		echo "test empty";
		$this->auth["read"] = array();
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["read"]);
		
		echo "test with studen attrib";
		$this->auth["denyShibAttrib"] = array("student");
		$this->auth["read"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["read"]);
		
		echo "with affiliation different from denied attribut";
		$_SERVER['HTTP_SHIB_EP_AFFILIATION'] = "staff";
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["read"]);
	}
	
	public function testWrite() {
		//test with *
		$this->auth["write"] = array("*");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		//test with group
		$this->auth["write"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		//test empty
		$this->auth["write"] = array();
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["write"]);
		
		//test with studen attrib
		$this->auth["denyShibAttrib"] = array("student");
		$acl = System::auth($this->auth);
		$this->assertFalse($acl["write"]);
				
		//overwrite is different from write
		$this->auth["overwrite"] = array("fbm-dpt-test-g");
		$this->auth["write"] = array("fbm-dpt-g");
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
		
		//overwrite is specified but not write (inherit)
		$this->auth["overwrite"] = array("fbm-dpt-g");
		$this->auth["write"] = array();
		$acl = System::auth($this->auth);
		$this->assertTrue($acl["write"]);
	}	
}
?>