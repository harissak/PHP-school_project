
<?php


require_once '../Model/AccesDB.php';
session_start();


if($_SESSION['page']==='categorie' || $_SESSION['table']==='categorie') {

    insertCategorie();
    allNull();


} else if ($_SESSION['page']==='membre' || $_SESSION['table']==='membre') {

 
       insertMembre();
       allNull();
} else if ($_SESSION['page']==='club' || $_SESSION['table']==='club') {

 
    insertClub();
    allNull();
} else if ($_SESSION['page']==='turnoi' || $_SESSION['table']==='turnoi') {

 
    insertTurnoi();
    allNull();
}else if ($_SESSION['page']==='judgearbitre' || $_SESSION['table']==='judgearbitre') {

 
    insertAdmin();
    allNull();
}else if ($_SESSION['page']==='administrateur' || $_SESSION['table']==='turnoi') {

 
    insertAdmin();
    allNull();
}else if ($_SESSION['page']==='participer' || $_SESSION['table']==='participer') {

 
    insertParticipent();
    allNull();
} else {
    echo "Something went wrong!!";
    echo $_SESSION['page'];
    echo $_SESSION['table'];
}




     function insertMembre() {
        $accessDB= new AccesDB();

        if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        }
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $codePostal = $_POST['codePostal'];
        $localite = $_POST['localite'];
        $rue = $_POST['rue'];
        $gsm = $_POST['gsm'];
        $dateDeNaissance = $_POST['dateDeNaissance'];
        $serie = $_POST['serie'];
        $categorie = $_POST['categorie'];
        $codeClub = $_POST['codeClub'];
        $motDePass = $_POST['motDePass'];
        $email = $_POST['email']; 
        

        if(isset($_POST['insertMembre'])) {         
            $totalPointsSaison ='0';
                
                $checkEmail= $accessDB->checkEmail($email);

                if($checkEmail>0) {
                   echo"Email already in use. Please go back and try with another email";
                    $_SESSION['page']='null';
                    $_SESSION['table']='null';
                    $_SESSION['role']='null';

                } else {
                    
                
                    $membreInsert = $accessDB->newMembre ($nom, $prenom, $codePostal,$localite, $rue, $gsm,
                    $dateDeNaissance, $serie, $categorie,$codeClub, $motDePass, $email);
                  
                    if(!$membreInsert) {
                        die("Error insert member");
                    } else {
                        header("Location: ../View/membre-view.php");
                            
                    }
                }
        } else {

                if(isset($_POST['updateMembre'])) {
                    $totalPointsSaison =$accessDB-> getPoints($email);
        

                    if ($_SESSION['role']==='admin') {

                    $totalPointsSaison = $_POST['totalPointsSaison'];
                        
                    }
        
                        if(isset($_SESSION['id_admin'])){
                
                                $accessDB= new AccesDB();
                                $membreUpdate = $accessDB->updateMembre ($id,$nom, $prenom, $codePostal,$localite, $rue, $gsm,
                                                        $dateDeNaissance, $serie, $categorie,$codeClub, 
                                                        $motDePass, $email, $totalPointsSaison);
                                if(!$membreUpdate) {
                                    die("Error update member");
                                } else {
                                    header("Location: ../View/membre-view.php");
                                                        
                                }
                         } else {
                            echo "ID SESSION IS NOT SET";
                        }
                } 
    
        } 
    } 

     function insertClub(){

            $id=$_SESSION['id'];
            $nom = $_POST['nom'];
            $cpl = $_POST['codePostal'];
            $ville = $_POST['localite']; 
            $rue = $_POST['rue'];
            $responsable = $_POST['responsable']; 

        if(isset($_POST['insertClub'])) {         

            $accessDB= new AccesDB();
            $insertClub = $accessDB->newClub ($nom, $cpl,$ville,$rue,$responsable);

            if(!$insertClub) {
                die("error insert club");
            } else {
                header("Location: ../View/club-view.php");
                    
            }

          } else {
                if(isset($_POST['updateClub'])) {
    
                    $accessDB= new AccesDB();
                    $updateClub = $accessDB->updateClub ($id,$nom, $cpl,$ville,$rue,$responsable);
                
                    if(!$updateClub) {
                        die("error update club");
                    } else {
                        header("Location: ../View/club-view.php");
                                       
                    }

                } else {
                    echo "ID SESSION IS NOT SET";
                }

              } 
    
     } 

    function insertTurnoi(){

        $id=$_SESSION['id'];
        $codeTurnoi = $_POST['turnoiCode'];
        $dtt = $_POST['dtturnoi'];
        $nomCat = $_POST['nomCategorie']; 
        $codeClub = $_POST['codeClub'];

        if(isset($_POST['insertTurnoi'])) {                   
            $accessDB= new AccesDB();
            $insertTurnoi = $accessDB->newTurnoi ($codeTurnoi,$dtt,$nomCat,$codeClub);

            if(!$insertTurnoi) {
                die("error insert turnoi");
            } else {
                header("Location: ../View/turnoi-view.php");
                    
            }

        } else {
                if(isset($_POST['updateTurnoi'])) {

                    $accessDB= new AccesDB();
                    $updateTurnoi = $accessDB->updateTurnoi ($id,$codeTurnoi,$dtt,$nomCat,$codeClub);
                
                    if(!$updateTurnoi) {
                        die("error update turnoi");
                    } else {
                        header("Location: ../View/turnoi-view.php");
                                              
                    }

                } else {
                    echo "ID SESSION IS NOT SET";
                }

            } 
        
    }
    function insertCategorie(){

        if(isset($_POST['insertCategorie'])) {
     
            $nom = $_POST['nom'];
            $ageMin = $_POST['ageMin'];
            $ageMax = $_POST['ageMax']; 
    
            $accessDB= new AccesDB();
            $categoriesInsert = $accessDB->newCategorie ($nom, $ageMin, $ageMax);
            if(!$categoriesInsert) {
                die("error insert categorie");
            } else {
                header("Location: ../View/categories-view.php");
                    
            }
          } else {
            if(isset($_POST['updateCategorie'])) {
    
                    if(isset($_SESSION['id'])){
            
                    $id = $_SESSION['id'];
                    $nom = $_POST['nom'];
                    $ageMin = $_POST['ageMin'];
                    $ageMax = $_POST['ageMax']; 
    
                    $accessDB= new AccesDB();
                    $categoriesInsert = $accessDB->updateCategorie ($id,$nom, $ageMin, $ageMax);
                    if(!$categoriesInsert) {
                        die("error update categorie");
                    } else {
                        header("Location: ../View/categories-view.php");
                                          
                    }
                } else {
                    echo "ID SESSION IS NOT SET";
                }
              } 
    
          } 
        
    }

    function insertAdmin(){

        $id=$_SESSION['id'];
        $id_membre = $_POST['id_membre'];
        $table = $_SESSION['page'];
        $accessDB= new AccesDB();

        $res = $accessDB->adminNbrCheck("administrateur",$id_membre);

               if(isset($_POST['insertJudgeAdmin'])) {         

                    //check if admin is already added
                    if($res >= 1){
                        echo "!ERROR - Admin with id number $id_membre is already added";

                    } else {

                        
                        $insertJA = $accessDB->newJudgeAdmin($id_membre,$table);

                        if(!$insertJA) {
                            die("error insert admin-judge");
                        } else {
                            header("Location: ../index.php");
                                
                        }
                    }

                } else {
                        if(isset($_POST['updateJudgeAdmin'])) {

                            $accessDB= new AccesDB();
                            $updateJudgeAdmin = $accessDB->updateJudgeAdmin ($id,$id_membre,$table);
                        
                            if(!$updateJudgeAdmin) {
                                die("error update Judge/Admin");
                            } else {
                                header("Location: ../index.php");
                                                    
                            }

                        } else {
                            echo "ID SESSION IS NOT SET";
                        }

                 } 

    }
   
    function insertParticipent(){

        
        $id=$_SESSION['id'];
        $nom = $_POST['id_membre'];
        $turnoi = $_POST['id_turnoi'];
        $score = $_POST['score'];



        if(isset($_POST['insertResult'])) {
     
               
    
            $accessDB= new AccesDB();
            $resultInsert = $accessDB->newResult ($nom, $turnoi, $score);
            if(!$resultInsert) {
                die("error insert result");
            } else {
                header("Location: ../View/participer-view.php");
                    
            }
          } else {
            if(isset($_POST['updateResult'])) {
    
                     if(isset($_SESSION['id'])){
                
                        
                        $accessDB= new AccesDB();
                        $updateResult = $accessDB->updateResult ($id,$nom, $turnoi, $score);
                        if(!$updateResult) {
                            die("error update result");
                        } else {
                            header("Location: ../View/participer-view.php");
                                            
                        }
                    } else {
                        echo "ID SESSION IS NOT SET";
                    }
              } 
    
          } 
    }

    function allNull () {
        $_SESSION['page'] = null;
        $_SESSION['table'] = null;
    }



    
?>