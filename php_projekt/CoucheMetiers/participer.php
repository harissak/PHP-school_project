<?php 

class participer {

    private $id;
    private $id_membre;
    private $score;
    private $id_turnoi;


    function __construct($id=null, $id_membre=null,$id_turnoi=null, $score=null) 
    {
        $this->id = $id;
        $this->id_membre = $id_membre;
        $this->score = $score;
        $this->id_turnoi =$id_turnoi;
        
    }

    public function setID ($id) {

        $this->id=$id;
    }
    
    public function setID_membre ($id_membre) {

        $this->id_membre=$id_membre;
    }

    public function setScore ($score){
        $this->score=$score;
    }

    public function getID () {

        return ($this->id);
    }

    public function getID_membre () {

        return ($this->id_membre);
    }

    public function getScore () {
        return ($this->score);
    }

    public function getID_turnoi () {
        return ($this->id_turnoi);
    }

    public function setID_turnoi ($id_turnoi){
        $this->id_turnoi=$id_turnoi;
    }


}
?>