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
    private $acl;
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
            $acl = array(),
            $isLogged = false,
            $maxEvents = 1,
            $category = "") {
        $this->id = $id;
        $this->description = $description;
        $this->name = $name;
        $this->manager = $manager;
        $this->building = $building;
        $this->local = $local;
        $this->acl = $acl;
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

    public function getAcl() {
        return $this->acl;
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
