<?php

class administrateur {

    private $id;
    private $id_membre;

    function __construct ($id=null, $id_membre=null){
        $this->id = $id;
        $this->id_membre = $id_membre;
    }

    public function setID ($id) {
        $this->id=$id;
    }

    public function getID() {
        return ($this->id);
    }

    public function setID_membre ($id_membre) {
        $this->id_membre=$id_membre;
    }

    public function getID_membre() {
        return ($this->id_membre);
    }

}
?>