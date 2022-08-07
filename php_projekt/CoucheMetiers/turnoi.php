<?php

class turnoi {

    private $id;
    private $turnoiCode;
    private $codeClub;
    private $dtturnoi;
    private $nomCategorie;


    function __construct($id=null,$turnoiCode=null, $codeClub=null, $dtturnoi=null, $nomCategorie=null)
    {
        $this->coidde = $id;
        $this->codeClub = $codeClub;
        $this->dtturnoi = $dtturnoi;
        $this->nomCategorie = $nomCategorie;     
        $this->turnoiCode = $turnoiCode;
            
    }

    public function setID ($id) {

        $this->id=$id;
    }

    public function setCodeClub ($codeClub) {

        $this->codeClub = $codeClub;
    }

    public function setDtturnoi ($dtturnoi) {

        $this->dtturnoi=$dtturnoi;
    }

    public function setNomCategorie ($nomCategorie) {

        $this->nomCategorie=$nomCategorie;
    }

    public function getID () {

        return ($this->id);
    }

    public function getCodeClub () {

        return ($this->codeClub);
    }

    public function getDtturnoi () {

        return ($this->dtturnoi);
    }

    public function getNomCategorie () {

        return ($this->nomCategorie);
    }

    public function setTurnoiCode ($turnoiCode) {

        $this->turnoiCode=$turnoiCode;
    }

    public function getTurnoiCode () {

        return ($this->turnoiCode);
    }


}

?>