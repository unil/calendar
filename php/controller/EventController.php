<?php

include_once("model/class/Event.php");
include_once("model/EventHandler.php");

class EventController {

	private $room;
	private $user;
	private $event;
	private $timeTable;
	private $return;
	private $insertAvailable;
	private $eventHandler;

	function __construct($room, $user) {

		$this->room = $room;
		$this->user = $user;
		$this->return["success"] = true;
		$this->eventHandler = new EventHandler();
		$this->insertAvailable = false;
	}

	public function setEvent($event) {
		$this->event = $event;
	}

	public function setInsertAvailable($insertAvailable) {
		$this->insertAvailable = $insertAvailable;
	}

	public function setTimeTable($timeTable) {
		$this->timeTable = $timeTable;
	}

	private function addExclusive() {
		/*
		 * BEGIN CRITICAL PART
		*
		* In this part, only one thread can be handled at once. All other
		* threads will wait.
		*/

		$file_handle = fopen('../tmp/calendar' . $this->room->getId() . '.lock', 'w+');
		$finish = false;
		$insertable = true;
		if ($file_handle) {
			while (!$finish) {
				if (flock($file_handle, LOCK_EX)) {
					$dates = null;
					$verifiedEvents = $this->eventHandler->checkAvailability($this->room, $this->timeTable, $this->event->getDBegin(), $this->event->getLastDate());

					if (count($verifiedEvents["unavailable"]) > 0 && !($this->insertAvailable)) {
						$this->return["success"] = false;
						$this->return["unavailable"] = $verifiedEvents["unavailable"];

						$insertable = false;
					} else {
						$dates = $verifiedEvents["available"];
					}
					if ($insertable) {
						$this->eventHandler->add($this->room, $this->event, $dates);
					}

					$finish = true;
				}
			}
			fclose($file_handle);
		}
		else {
			$this->return["success"] = false;
			$this->return["system"] = "Could not open lock file";
		}
		/*
		 * END CRITICAL PART
		*/
	}

	public function action($action) {
		switch ($action) {
			case "delete-current" :
				$this->eventHandler->delete($this->room, $this->event, true);
				break;
			case "delete-all" :
				$this->eventHandler->delete($this->room, $this->event, false, $this->event->getDBegin());
				break;
			/*case "update-current-nodate" :
				$this->eventHandler->update($this->room, $this->event);
				break;
			case "update-current-withdate" :
				//create new independent event
				//OK FONCTIONNE
				$this->addExclusive();

				if ($this->return["success"]) {
					//delete current item from recurrent lists if new inserted

					$this->eventHandler->delete($this->room, $this->event);

				}
				break;*/
			case "update-all-nodate" :
				//$this->eventHandler->update($this->room, $this->event, $this->event->getDBegin());

				$siblings = $this->eventHandler->getSiblings($this->event, $this->event->getDBegin());

				$dates = null;

				foreach($siblings as $sibling) {
					$dates[$sibling["date"]] = array("start" => $sibling["start"],
                                                        "end" => $sibling["end"]);
					 
				}

				$this->eventHandler->update($this->room, $this->event, $dates);

				break;
			case "update-all-withdate" :
				//create new independent event

				$this->addExclusive();

				if ($this->return["success"]) {
					//delete events
					$this->eventHandler->delete($this->room, $this->event, false, $this->event->getDBegin());
				}
				break;
			case "add" :
				$this->addExclusive();
				break;
			default :
				$this->return["success"] = false;
			$this->return["action"] = $action;
		}

	}

	public function getReturn() {
		return $this->return;
	}

}

?>