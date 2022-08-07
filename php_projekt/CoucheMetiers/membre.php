<?php

class membre {

    private $id;
    private $nom;
    private $prenom;
    private $codePostal;
    private $localite;
    private $rue;
    private $gsm;
    private $dateDeNaissance;
    private $serie;
    private $categorie;
    private $codeClub;
    private $totalPointsSaison;
    private $moteDePass;
    private $email;

    function __construct($id=null, $nom=null, $prenom=null, $codePostal=null, $localite= null, 
    $rue=null,$gsm=null,$dateDeNaissance=null,$serie=null,$categorie=null,$codeClub=null,
    $totalPointsSaison=null,$moteDePass=null,$email=null)
    {
        $this->id=$id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->codePostal = $codePostal;
        $this->localite = $localite;
        $this->rue = $rue;
        $this->gsm = $gsm;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->serie = $serie;
        $this->categorie = $categorie;
        $this->codeClub = $codeClub;
        $this->totalPointsSaison = $totalPointsSaison;  
        $this->moteDePass = $moteDePass;
        $this->email = $email;

        
    }

    public function setID ($id) {

        $this->id=$id;
    }

    public function setNom ($nom) {

        $this->nom=$nom;
    }

    public function setPrenom ($prenom) {

        $this->prenom=$prenom;
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

    public function setGsm ($gsm) {

        $this->gsm=$gsm;
    }

    public function getID () {

        return ($this->id);
    }

    public function getNom () {

        return ($this->nom);
    }

    public function getPrenom () {

        return ($this->prenom);
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

    public function getGsm () {

        return ($this->gsm);
    }
    public function setDateDeNaissance ($dateDeNaissance) {

        $this->dateDeNaissance=$dateDeNaissance;
    }

    public function getDateDeNaissance () {

        return ($this->dateDeNaissance);
    }

    public function setSerie ($serie) {

        $this->serie=$serie;
    }

    public function getSerie () {

        return ($this->serie);
    }

    public function setCategorie ($categorie) {

        $this->categorie=$categorie;
    }

    public function getCategorie () {

        return ($this->categorie);
    }

    public function setCodeClub ($codeClub) {

        $this->codeClub=$codeClub;
    }

    public function getCodeClub () {

        return ($this->codeClub);
    }

    public function setTotalPointsSaison ($totalPointsSaison) {

        $this->totalPointsSaison=$totalPointsSaison;
    }

    public function getTotalPointsSaison () {

        return ($this->totalPointsSaison);
    }

    public function setMoteDePass ($moteDePass) {

        $this->moteDePass=$moteDePass;
    }

    public function getMoteDePass () {

        return ($this->moteDePass);
    }

    public function setEmail ($email) {

        $this->email=$email;
    }

    public function getEmail () {

        return ($this->email);
    }
    
    
    
    
    
    

}
?>