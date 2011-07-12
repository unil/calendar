<?php

/**
 * Description of Event
 *
 * @author smeier
 */
class Event {

    private $id;
    private $owner;
    private $title;
    private $description;
    private $dBegin;
    private $hBegin;
    private $dEnd;
    private $hEnd;
    private $lastDate;
    private $mode;
    private $dateId;

       /* public function __construct($id, $owner, $title, $description, $date, $dBegin, $end, $dateId, $mode) {
        
    }*/

    function __construct($id, $owner = null, $title = null, $description = null, $dBegin = null, $hBegin = null, $dEnd = null, $hEnd = null, $mode = null, $dateId = null, $lastDate = null) {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
        $this->description = $description;
        $this->dBegin = $dBegin;
        $this->hBegin = $hBegin;
        $this->dEnd = $dEnd;
        $this->hEnd = $hEnd;
        $this->mode = $mode;
        $this->dateId = $dateId;
        $this->lastDate = $lastDate;
    }
    public function getId() {
        return $this->id;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDBegin() {
        return $this->dBegin;
    }

    public function getHBegin() {
        return $this->hBegin;
    }

    public function getDEnd() {
        return $this->dEnd;
    }

    public function getHEnd() {
        return $this->hEnd;
    }

    public function getMode() {
        return $this->mode;
    }
    
    public function setMode($mode) {
    	return $this->mode = $mode;
    }

    public function getDateId() {
        return $this->dateId;
    }
    public function getLastDate() {
        return $this->lastDate;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDBegin($dBegin) {
        $this->dBegin = $dBegin;
    }

    public function setDEnd($dEnd) {
        $this->dEnd = $dEnd;
    }

}

?>
