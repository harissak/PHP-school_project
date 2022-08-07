<?php
require_once 'DB_mysqli.php';


class AccesDB {
    private $connection;

    public function requet (string $sql) {
        $this->connection = DB_mySqli::getInstance();

        return $this->connection->query($sql);
    } 

    //lister les categories
    public function ListerLesCategories($table) {
        $conn=DB_mySqli::getInstance();
        $lesCategoriesDisp = array();

        $result = $this->selectAll($table);  
         
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $cat = new $table();
                $this->setValue($cat, $row);
                $lesCategoriesDisp[]= $cat;


            }
        return $lesCategoriesDisp;

    }

    //lister les turnoi
    public function ListerLesTurnoi() {

        require_once '../CoucheMetiers/turnoi.php';
        $lesTurnoiDisp = array();

        $query="select turnoi.id, turnoi.turnoiCode, turnoi.dtturnoi, categorie.nom as nomCategorie, club.nom as codeClub 
        from ((turnoi inner join categorie on turnoi.nomCategorie = categorie.id)
        inner join club on turnoi.codeClub = club.id)";

        $result = $this->requet($query);

        if(!$result) {

            $this->connection->close();
            die("error");
        }

        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $cat = new turnoi();
                $this->setValue($cat, $row);
                $lesTurnoiDisp[]= $cat;


            }
        return $lesTurnoiDisp;

    }

    //lister les results
    public function ListerLesResult() {

        require_once '../CoucheMetiers/participer.php';
    
        $lesResultDisp = array();


        $query="select participer.id, membre.nom as id_membre, turnoi.turnoiCode as id_turnoi, participer.score 
        from ((participer inner join membre on participer.id_membre = membre.id)
        inner join turnoi on participer.id_turnoi = turnoi.id)
        order by participer.id_turnoi, participer.score desc";

        $result = $this->requet($query); 

        if(!$result) {

            $this->connection->close();
            die("error");
        }

        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $res = new participer();
                $this->setValue($res, $row);
                $lesResultDisp[]= $res;


            }
        return $lesResultDisp;

    }

    public function ListerLesClub() {
       
        require_once '../CoucheMetiers/club.php';
      
        $query="select club.id, club.nom, club.codePostal, club.localite, club.rue, membre.nom as responsable
        from club inner join membre on club.responsable = membre.id";

        $result = $this->requet($query);
        
        return $result;

    }

    //lister les membre
    public function ListerLesMembre() {
       
        require_once '../CoucheMetiers/membre.php';
        $membreList = array();


        $query= "select membre.id,membre.nom,membre.prenom,membre.codePostal, membre.localite, membre.rue, membre.gsm, membre.dateDeNaissance, membre.serie, categorie.nom as categorie, club.nom as codeClub, membre.totalPointsSaison, membre.moteDePass, membre.email
        FROM ((membre INNER JOIN categorie ON membre.categorie =categorie.id) INNER JOIN club ON membre.codeClub = club.id)";  
        
        $result = $this->requet($query);

            if(!$result) {

                $this->connection->close();
                die("error");
            }        
            
            $rows= $result->num_rows;
            for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                    $membre = new membre();
                    $this->setValue($membre, $row);
                    $membreList[]= $membre;


                }
        return $membreList;

    }

    //lister les joudges
    public function ListerLesJudgearbitre() {

        require_once '../CoucheMetiers/judgearbitre.php';

        $lesJudgeDisp = array();

        $query = "select judgearbitre.id, membre.nom as id_membre
        from judgearbitre inner join membre on judgearbitre.id_membre = membre.id";

        $result = $this->requet($query);

        if(!$result) {

            $this->connection->close();
            die("error in connection to database");
        }
         
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $judge = new judgearbitre();
                $this->setValue($judge, $row);
                $lesJudgeDisp[]= $judge;


            }
        return $lesJudgeDisp;

    }

    //lister les administrateurs
    public function ListerLesAdministrateurs() {
        require_once '../CoucheMetiers/administrateur.php';
     
        $lesAdminsDisp = array();

        $query = "select administrateur.id, membre.nom as id_membre
        from administrateur inner join membre on administrateur.id_membre = membre.id";

        $result = $this->requet($query); 

        if(!$result) {

            $this->connection->close();
            die("error");
        }
         
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $admin = new administrateur();
                $this->setValue($admin, $row);
                $lesAdminsDisp[]= $admin;


            }
        return $lesAdminsDisp;

    }

    //select everything from tables
    public function selectAll ($table) {

       
        $query = "SELECT * FROM $table";
        $result = $this->requet($query);

        if(!$result) {

            $this->connection->close();
            die("error");
        }

        return $result;

    }

    //set values to construct
    public function setValue ($object, $row) {
        foreach($row as $key => $value) {

            $setter = 'set'. ucfirst($key);
            if(method_exists($object, $setter)){
                $object->$setter(htmlspecialchars($value));
            } else {
                printf('Error', $setter);
            }
        }
    }

    public function countRows ($table) : int  {
       

        $query = "SELECT count(*) as nbr FROM $table";
        $result = $this->requet($query);
    
            if(!$result) {
    
                $this->connection->close();
                die("error");
            }
        $nbrRow = mysqli_fetch_array($result);

        return intval($nbrRow['nbr']);
       

        
    }

    //delete from table 
    public function deleteFromTable($id, $tableDelete){

      
                $query = "delete FROM ".$tableDelete." where id = ".$id;
                $result = $this->requet($query);

                if(!$result) {
                    $this->connection->close();
                    die("Error! Can not delete");
                } 

                return $result;
            
    }

    //insert new categorie
    public function newCategorie ($nom, $ageMin, $ageMax) {
       
        $query = "INSERT INTO categorie (nom, ageMin,ageMax) values ('".$nom."','".$ageMin."','".$ageMax."');";
        $result = $this->requet($query); 
        $this->connection->close();

        return $result;
    }

    //update categorie
    public function updateCategorie($id, $nom, $ageMin, $ageMax) {
        
        $query= "UPDATE categorie SET nom ='$nom',ageMin='$ageMin',ageMax='$ageMax' WHERE id = ".$id;
        $result = $this->requet($query); 
        $this->connection->close();

        return $result;
    }

    //insert new member
    public function newMembre ($nom, $prenom, $codePostal,$localite, $rue, $gsm, $dateDeNaissance, $serie, $categorie,$codeClub, $moteDePass, $email) {

        $query = "INSERT INTO membre (nom, prenom, codePostal, localite, rue, gsm, dateDeNaissance, serie, categorie, codeClub, totalPointsSaison, moteDePass, email)
         values ('".$nom."','".$prenom."','".$codePostal."','".$localite."','".$rue."','".$gsm."','".$dateDeNaissance."','".$serie."','".$categorie."','".$codeClub."','0','".$moteDePass."','".$email."');";
        $result = $this->requet($query); 
      

        return $result;
    }

    //update membre
    public function updateMembre($id,$nom, $prenom, $codePostal,$localite, $rue, $gsm,$dateDeNaissance, $serie, $categorie,$codeClub, $moteDePass, $email, $totalPointsSaison) {
        
        $query= "UPDATE membre SET nom ='$nom',prenom='$prenom',codePostal='$codePostal',localite ='$localite',rue='$rue',gsm='$gsm',dateDeNaissance ='$dateDeNaissance',serie='$serie',categorie='$categorie',codeClub ='$codeClub',moteDePass='$moteDePass',email='$email',totalPointsSaison ='$totalPointsSaison' 
        WHERE id = ".$id;
        $result = $this->requet($query); 

        return $result;
    }

    //insert club
    public function newClub($nom, $cpl,$ville,$rue,$responsable){
        
        $query = "INSERT INTO club (nom, codePostal, localite, rue,responsable)
         values ('".$nom."','".$cpl."','".$ville."','".$rue."','".$responsable."');";
        $result = $this->requet($query); 
       
        return $result;

    }

    //update club
    public function updateClub($id,$nom, $cpl,$ville,$rue,$responsable){
       
        $query= "UPDATE club SET nom ='$nom',codePostal='$cpl',localite ='$ville',rue='$rue',responsable='$responsable' WHERE id = ".$id;
        $result = $this->requet($query);
        $this->connection->close();

        return $result;
    }

    //new turnoi
    public function newTurnoi ($codeTurnoi,$dtt,$nomCat,$codeClub){
       
        $query = "INSERT INTO turnoi (turnoiCode,dtturnoi, nomCategorie,codeClub)
         values ('".$codeTurnoi."','".$dtt."','".$nomCat."','".$codeClub."');";
        $result = $this->requet($query);
    

        return $result;

    }

    //update turnoi
    public function updateTurnoi ($id,$codeTurnoi,$dtt,$nomCat,$codeClub){
        
        $query= "UPDATE turnoi SET dtturnoi ='$dtt',nomCategorie='$nomCat',turnoiCode='$codeTurnoi',codeClub ='$codeClub' WHERE id = ".$id;
        $result = $this->requet($query); 

        return $result;
    }

     //new admin-judge
     public function newJudgeAdmin($id_membre,$table){
        
        $query = "INSERT INTO $table (id_membre)values ('".$id_membre."');";
        $result = $this->requet($query); 
        $this->connection->close();

        return $result;
 

    }

     //update admin-judge
     public function updateJudgeAdmin($id,$id_membre,$table){
        
        $query = "UPDATE $table SET id_membre ='$id_membre' WHERE id = ".$id;
        $result = $this->requet($query); 

        return $result;
 
    }

    //new result
    public function newResult ($nom, $turnoi, $score) {
          
        $query = "INSERT INTO participer (id_membre, id_turnoi, score)values ('".$nom."','".$turnoi."','".$score."');";
        $result = $this->requet($query); 

        return $result;
 
    }

    //update result
    public function updateResult ($id,$nom, $turnoi, $score) {
        
        $query = "UPDATE participer SET id_membre ='$nom',id_turnoi ='$turnoi',score ='$score'  WHERE id = ".$id;
        $result = $this->requet($query); 

        return $result;
    }

    //search categories 
    public function searchTables ($text) {
        
        $query= "SELECT * FROM categorie WHERE id LIKE '%$text%' OR nom LIKE '%$text%' OR ageMin LIKE '%$text%' OR ageMax LIKE '%$text%'";
        $result = $this->requet($query); 
        $lesCategoriesDisp = array();
       
        if(!$result) {

            $this->conectionn->close();
            die("error ovdje");
        } 
       
        $rows= $result->num_rows;

        for($i=0; $i<$rows; ++$i) {

            $row=$result->fetch_array(MYSQLI_ASSOC);

                $categorie = new categorie();
                $this->setValue($categorie, $row);
                $lesCategoriesDisp[]= $categorie;


        }

        return $lesCategoriesDisp;
       
    }

    //search membre
    public function searchMembreTeble ($text) { 

        
        require_once '../CoucheMetiers/membre.php';

        $query= "SELECT * FROM membre WHERE id LIKE '%$text%' OR nom LIKE '%$text%' 
        OR prenom LIKE '%$text%' OR codePostal LIKE '%$text%' OR localite LIKE '%$text%'
        OR rue LIKE '%$text%' OR gsm LIKE '%$text%' OR categorie LIKE '%$text%'
        OR codeClub LIKE '%$text%' OR totalPointsSaison LIKE '%$text%'";

        $result = $this->requet($query); 
        $lesMembreList = array();
        
        if(!$result) {

            $this->connection->close();
            die("Error search membre");
        } 

        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                $membre = new membre();
                $this->setValue($membre, $row);
                $lesMembreList[]= $membre;

            }

        return $lesMembreList;
    }

    // search club
    public function searchClubTable ($text) {
        
        $query= "SELECT * FROM club WHERE id LIKE '%$text%' OR nom LIKE '%$text%' 
        OR codePostal LIKE '%$text%' OR localite LIKE '%$text%'
        OR rue LIKE '%$text%' OR responsable LIKE '%$text%'";
      
        $result = $this->requet($query); 

        if(!$result) {

            $this->conectionn->close();
            die("error");
        }

      return $result;
            
    }

    //search admin
    public function searchAdministrateurTable ($text) {
        
        $query= "SELECT * FROM administrateur WHERE id LIKE '%$text%'";
        $result = $this->requet($query);
        $lesAdminList = array();
        if(!$result) {

            $this->connection->close();
            die("Error search membre");
        } 
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                $administrateur = new administrateur();
                $this->setValue($administrateur, $row);
                $lesAdminList[]= $administrateur;


            }

        return $lesAdminList;
    }

    //search judge
    public function searchJudgeTable ($text) {
        
        $query= "SELECT * FROM judgearbitre WHERE id LIKE '%$text%'";
        $result = $this->requet($query); 
        $lesJudgeList = array();
        if(!$result) {

            $this->conectionn->close();
            die("Error search membre");
        } 
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                $judgearbitre = new judgearbitre();
                $this->setValue($judgearbitre, $row);
                $lesJudgeList[]= $judgearbitre;

            }

        return $lesJudgeList;
    }

    //search turnoi
    public function searchTurnoiTable ($text) {
       
        $query= "SELECT * FROM turnoi WHERE id LIKE '%$text%' OR dtturnoi LIKE '%$text%' OR nomCategorie LIKE '%$text%' OR codeClub LIKE '%$text%'";
        $result = $this->requet($query);
        $lesTurnoiList = array();
      
        if(!$result) {

            $this->connection->close();
            die("Error search turnoi");
        } 

        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                $turnoi = new turnoi();
                $this->setValue($turnoi, $row);
                $lesTurnoiList[]= $turnoi;

            }

        return $lesTurnoiList;
    }

    //search participant
    public function searchResultTable($text) {
        
        require_once '../Controller/participer.php';
     
        $query= "SELECT * FROM participer WHERE id LIKE '%$text%' OR id_membre LIKE '%$text%' 
        OR score LIKE '%$text%' OR id_turnoi LIKE '%$text%'";
        $result = $this->requet($query); 
        $lesParticipentList = array();
       
        if(!$result) {

            $this->connection->close();
            die("Error search result");
        } 
        $rows= $result->num_rows;
           for($i=0; $i<$rows; ++$i) {

                $row=$result->fetch_array(MYSQLI_ASSOC);

                $participer = new participer();
                $this->setValue($participer, $row);
                $lesParticipentList[]= $participer;


            }

        return $lesParticipentList;
    }

    public function checkEmail ($email) {
        
        $query= "select * FROM membre WHERE email LIKE '%$email%'";
        $result = $this->requet($query); 
        
        $rows= $result->num_rows;

        return $rows;       
          
    }

    public function getPoints($email) {

        
        $query= "SELECT * FROM MEMBRE WHERE email = '$email'";
        $result = $this->requet($query);

        if(!$result) {
            $this->connection->close();
            die("Not possible to connect and find points from member");
        }


        $points=0;

        while($row = mysqli_fetch_array($result)) {
            $points = $row['totalPointsSaison'];
  
        }

        return $points;
    }

    //new season
    public function startNewSeason() {
        
        $query = "delete FROM participer";
        $query2 = "delete FROM turnoi";
        
       $result = $this->requet($query); 

        if(!$result) {

            $this->conectionn->close();
            die("error query 1");
        }

        $result = $this->requet($query2); 

        if(!$result) {

            $this->connection->close();
            die("error query 2");
        }

        return $result;

    }

    //lister les resultats
    public function resultatsListIndex(){

        $query = "select membre.id as id, membre.nom, membre.prenom, club.nom as club, categorie.nom as categorie, sum(participer.score) as points
            from (((membre INNER JOIN club on membre.codeClub=club.id) 
            INNER JOIN categorie on membre.categorie = categorie.id)
            inner join participer on membre.id = participer.id_membre)
            group by membre.id
            order by categorie.id, points desc;";
        
        $result = $this->requet($query);

        if(!$result) {
        $this->connection->close();
        die("error");
        }

        return $result;
    }

    //select membre by email
    public function selectMembreByEmail ($email) {

        $query= "SELECT * FROM MEMBRE WHERE email = '{$email}'";

        $result = $this->requet($query);

        if(!$result) {
            $this->connection->close();
            die("Not possible to connect and find member according to email");
        }

        while($row = mysqli_fetch_array($result)) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['motDePass'] = $row['moteDePass'];
            $_SESSION['id_admin'] = $row['id'];
            
  
        }

        return $result;

    }

     //select admin data
     public function adminData ($table,$id) {

       
        $query = "SELECT * FROM $table where id_membre = $id";
        $result = $this->requet($query);

        if(!$result) {

            $this->connection->close();
            die("error");
        }
        

        while($row = mysqli_fetch_array($result)) {
 
            $_SESSION['admin_id'] = $row['id_membre'];
    
        }

        return $result;

    }

    //select nbr of rows of admin table
    public function adminNbrCheck ($table,$id) {

       
            $query = "SELECT * FROM $table where id_membre = $id";
            $result = $this->requet($query);
    
            if(!$result) {
    
                $this->connection->close();
                die("error");
            }

            $row = mysqli_num_rows($result);
    
            return $row;
    
    }

    //select from table with id
    public function selectByID ($table, $id) {

        $query = "select * FROM {$table} where id = ".$id;
        $result = $this->requet($query);
       
       if(!$result) {
        $this->connection->close();
        die("error");
        }

        return $result;
    }
   
}

?>