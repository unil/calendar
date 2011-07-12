<?php

class OldRoom {

    private $id;
    private $building_id;
    private $local;
    private $name;
    private $description;
    private $admin;
    private $super_admin;
    private $accept_students;
    private $monitoring;

    function __construct($id, $building_id, $local, $name, $description, $admin, $super_admin, $accept_students, $monitoring) {
        $this->id = $id;
        $this->building_id = $building_id;
        $this->local = $local;
        $this->name = $name;
        $this->description = $description;
        $this->admin = $admin;
        $this->super_admin = $super_admin;
        $this->accept_students = $accept_students;
        $this->monitoring = $monitoring;
    }

    public function getId() {
        return $this->id;
    }

    public function getBuilding_id() {
        return $this->building_id;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getSuper_admin() {
        return $this->super_admin;
    }

    public function getAccept_students() {
        return $this->accept_students;
    }

    public function getMonitoring() {
        return $this->monitoring;
    }


}

?>
