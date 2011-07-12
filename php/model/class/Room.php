<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Building
 *
 * @author smeier
 */
class Room {

    private $id;
    private $description;
    private $name;
    private $manager;
    private $building;
    private $local;
    private $admins;
    private $superAdmin;
    private $acceptStudents;
    private $isLogged;
    private $maxEvents;
    private $category;

    function __construct(
            $id,
            $description = "",
            $name = "",
            $manager = "",
            $building = "",
            $local = "",
            $admins = array(),
            $superAdmin = array(),
            $acceptStudents = true,
            $isLogged = false,
            $maxEvents = 1,
            $category = "") {
        $this->id = $id;
        $this->description = $description;
        $this->name = $name;
        $this->manager = $manager;
        $this->building = $building;
        $this->local = $local;
        $this->admins = $admins;
        $this->superAdmin = $superAdmin;
        $this->acceptStudents = $acceptStudents;
        $this->isLogged = $isLogged;
        $this->maxEvents = $maxEvents;
        $this->category = $category;
    }
    public function getId() {
        return $this->id;
    }
    public function getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function getBuilding() {
        return $this->building;
    }

    public function getLocal() {
        return $this->local;
    }

    public function getAdmins() {
        return $this->admins;
    }

    public function getSuperAdmins() {
        return $this->superAdmin;
    }

    public function getAcceptStudents() {
        return $this->acceptStudents;
    }

    public function getIsLogged() {
        return $this->isLogged;
    }

    public function getMaxEvents() {
        return $this->maxEvents;
    }
    public function getManager() {
        return $this->manager;
    }

    public function getCategory() {
        return $this->category;
    }



}

?>
