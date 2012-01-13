<?php

require_once("model/bean/Element.php");

class Person extends Element {
	private $firstName;
	private $lastName;
	private $phone;
	private $email;
	private $office;
	private $address;
	private $postCode;
	private $location;
	
	public function __construct($id, $firstName, $lastName, $email, $phone = null, $office = null, $address = null, $postCode = null, $location = null) {
		parent::__construct($id);
		$this->firstName = $firstName;

		$this->lastName = $lastName;
		$this->email = $email;
		$this->phone = $phone;
		$this->office = $office;
		$this->address = $address;
		$this->postCode = $postCode;
		$this->location = $location;
	}

	public function getFirstName()
	{
	    return $this->firstName;
	}

	public function getLastName()
	{
	    return $this->lastName;
	}

	public function getEmail()
	{
	    return $this->email;
	}	
	
	public function getPhone()
	{
	    return $this->phone;
	}

	public function getOffice()
	{
	    return $this->office;
	}

	public function getAddress()
	{
	    return $this->address;
	}

	public function getPostCode()
	{
	    return $this->postCode;
	}

	public function getLocation()
	{
	    return $this->location;
	}
	
	public function __toString() {
		return $this->firstName . " " . $this->lastName;
	}
}

?>