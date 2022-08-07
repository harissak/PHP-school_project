<?php 

class categorie {

    private $id;
    private $nom;
    private $ageMin;
    private $ageMax;
    
    function __construct($id=null, $nom=null, $ageMin=null, $ageMax=null)
    {
        $this->id= $id;
        $this->nom = $nom;
        $this->ageMin = $ageMin; 
        $this->ageMax = $ageMax;
        
    }

    public function setId ($id) {
        $this->id=$id;
    }

    public function getId() {
        return ($this->id);
    }

    public function setNom ($nom) {
        $this->nom=$nom;
    }

    public function getNom() {
        return ($this->nom);
    }

    public function setAgeMin ($ageMin) {
        $this->ageMin=$ageMin;
    }

    public function getAgeMin() {
        return ($this->ageMin);
    }

    public function setAgeMax ($ageMax) {
        $this->ageMax=$ageMax;
    }

    public function getAgeMax() {
        return ($this->ageMax);
    }
}


?>