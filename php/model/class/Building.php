<?php
/**
 * Description of Room
 *
 * @author smeier
 */
class Building {

    private $id;
    private $name;

    function __construct($id, $name = null) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    
    
}

?>
