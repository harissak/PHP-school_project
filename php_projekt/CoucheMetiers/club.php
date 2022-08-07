<?php 

class club {

    private $id;
    private $nom;
    private $codePostal;
    private $localite;
    private $rue;
    private $responsable;
    
    
    function __construct($id=null, $nom=null, $codePostal=null, $localite= null, $rue=null, $responsable=null)
    {
        $this->id=$id;
        $this->nom = $nom;
        $this->codePostal = $codePostal;
        $this->localite = $localite;
        $this->rue = $rue;
        $this->responsable = $responsable;
        
    }

    public function setCode ($id) {

        $this->id=$id;
    }

    public function setNom ($nom) {

        $this->nom=$nom;
    }

    public function setCodePostal ($codePostal) {

        $this->codePostal=$codePostal;
    }

    public function setLocalite ($localite) {

        $this->localite=$localite;
    }

    public function setRue ($rue) {

        $this->rue=$rue;
    }

    public function setResponsable ($responsable) {

        $this->responsable=$responsable;
    }

    public function getCode () {

        return ($this->id);
    }

    public function getNom () {

        return ($this->nom);
    }

    public function getCodePostal () {

        return ($this->codePostal);
    }

    public function getLocalite () {

        return ($this->localite);
    }

    public function getRue () {

        return ($this->rue);
    }

    public function getResponsable () {

        return ($this->responsable);
    }



}

?>