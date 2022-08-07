<?php

class Presentation {

   

    function __construct () {

    }

    // categories
    public function catdisp($lescatdisponible) {

        echo <<<__END

            <table class="content-table ">
                <tr>
                <thead>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>Age minimum</th>
                    <th>Age maximum</th>
                </tr>
                </thead>
                </table>

         __END;

        foreach($lescatdisponible as $unCat){
                $id = $unCat->getId();
                $maxAge = $unCat->getAgeMax();
                $minAge = $unCat->getAgeMin();
                $nom = $unCat->getNom();


         echo "
                <table class='content-table tableCat'>
                <tbody>
                <tr>
                    <td>$id</th>
                    <td class='td-name'>$nom</th>
                    <td >$minAge</th>
                    <td class='table-center'>$maxAge</th>
        ";
       
        if(isset($_SESSION['login'])){

            if(isset($_SESSION['role'])) {
        
                if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                    $_SESSION['table']='categorie';
                     
                    echo "
                  <td>
                   <a href='../Controller/delete.php?id=$id'>delete</a>
                   <a href='../Controller/update.php?id=$id'>update</a>
                      
                     </td>
                     ";
    
                
                  }
            }
        }

        echo "
                </tr>
                </tbody>
                </table>
                ";

            }
    }

    // members
    public function membersList($members) {

        echo <<<__END
            <table class="content-table ">
        <thead>
            <tr>
                <th>ID</th>
                <th>PRÉNOM</th>
                <th>NOM</th>
                <th>CPL</th>
                <th>VILLE</th>
                <th>RUE</th>
                <th>GSM</th>
                <th>DATE DE NAISSANCE</th>
                <th>SERIE</th>
                <th>CATEGORIE</th>
                <th>CLUB</th>
                <th>POINTS TOTAL</th>
            </tr>
            </thead>
            </table>
        
        __END;
        
            foreach($members as $unMembre){
                    $id = $unMembre->getID();
                    $nom = $unMembre->getNom();
                    $prenom = $unMembre->getPrenom();
                    $cpl = $unMembre->getCodePostal();
                    $ville = $unMembre->getLocalite();
                    $rue = $unMembre->getRue();
                    $gsm = $unMembre->getGsm();
                    $dateNess = $unMembre->getDateDeNaissance();
                    $serie = $unMembre->getSerie();
                    $categorie = $unMembre->getCategorie();
                    $codeClub = $unMembre->getCodeClub();
                    $points = $unMembre->getTotalPointsSaison();
                
        
                    echo "
                            <table class='content-table tableMembre'>
                            <tbody>
                            <tr>
                                <td>$id</td>
                                <td>$nom</td>
                                <td>$prenom</td>
                                <td>$cpl</td>
                                <td>$ville</td>
                                <td>$rue</td>
                                <td>$gsm</td>
                                <td>$dateNess</td>
                                <td>$serie</td>
                                <td>$categorie</td>
                                <td>$codeClub</td>
                                <td>$points</td>";
                                if(isset($_SESSION['login'])){

                                    if(isset($_SESSION['role'])) {
                                
                                        if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                                            $_SESSION['table']='membre';
                                             
                                            echo "
                                          <td>
                                           <a href='../Controller/delete.php?id=$id'>delete</a>
                                           <a href='../Controller/update.php?id=$id'>update</a>
                                              
                                            </td>
                                             ";
                            
                                        
                                          }
                                    }
                                }
                    echo "
                            </tr>
                            </tbody>
                            </table>
                            ";
                }
    }
 
    //turnoi list
    public function turnoiList($turnoi) {

        echo <<<__END

            <table class="content-table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CODE TURNOI</th>
                    <th>DATE DE TURNOI</th>
                    <th>NOM DE CATEGORIE</th>
                    <th>CLUB</th>
                    <th></th>
                </tr>
                </thead>
                </table>

            __END;

            foreach($turnoi as $unTurnoi){
                $id = $unTurnoi->getID();
                $codeTurn = $unTurnoi->getTurnoiCode();
                $dt_tr = $unTurnoi->getDtturnoi();
                $nomCat = $unTurnoi->getNomCategorie();
                $codeClub = $unTurnoi->getCodeClub();

                echo "
                <table class='content-table tableTurnoi'>
                <tbody>
                <tr>
                    <td>$id</td>
                    <td class='tdCodeTurnoi'>$codeTurn</td>
                    <td>$dt_tr</td>
                    <td>$nomCat</td>
                    <td>$codeClub</td>";
                    if(isset($_SESSION['login'])){

                        if(isset($_SESSION['role'])) {
                    
                            if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                                $_SESSION['table']='turnoi';
                                 
                                echo "
                              <td>
                               <a href='../Controller/delete.php?id=$id'>delete</a>
                               <a href='../Controller/update.php?id=$id'>update</a>
                                  
                                 </td>
                                 ";
                
                            
                              }
                        }
                    }
                    echo"
                    </form>
                    </td>
                    

                </tr>
                </tbody>
                </table>
                ";

            }

    }

    //club list
    public function clubList ($result) {

        echo <<<__END

            <table class="content-table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>CPL</th>
                    <th>Ville</th>
                    <th>Rue</th>
                    <th>Responsable</th>

                </tr>
                </thead>
                </table>
            __END;

           
                while($row = mysqli_fetch_assoc($result)) {
                
                    $id = $row['id'];
                    $nom = $row['nom'];
                    $cpl = $row['codePostal'];
                    $localite = $row['localite'];
                    $rue = $row['rue'];
                    $responsable = $row['responsable'];
                
                    echo "
                    <table class='content-table tableClub'>
                    <tbody>
                    <tr>
                        <td>$id</td>
                        <td class='tdClubName'>$nom</td>
                        <td>$cpl</td>
                        <td>$localite</td>
                        <td>$rue</th>
                        <td>$responsable</th>";
                        if(isset($_SESSION['login'])){

                            if(isset($_SESSION['role'])) {
                        
                                if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                                    $_SESSION['table']='club';
                                     
                                    echo "
                                  <td>
                                   <a href='../Controller/delete.php?id=$id'>delete</a>
                                   <a href='../Controller/update.php?id=$id'>update</a>
                                      
                                     </td>
                                     ";
                    
                                
                                  }
                            }
                        }
                        echo '
                       
                        </td>
                    </tr>
                    </tbody>
                    </table>
                    ';
                
                
                }
    }

    //admin list
    public function adminList($administrateur) {

        echo <<<__END
             

            <table class="content-table ">
            <thead>
                
                <tr>
                    <th class='adminTable'>ID</th>
                    <th class='adminTable'>NOM</th>
                </tr>
                </thead>
                </table>

            __END;

            foreach($administrateur as $unAdmin){
                $id = $unAdmin->getID();
                $nom = $unAdmin->getID_membre();

                echo "
                <table class='content-table tableAdmin'>
                <tbody>
                <tr>
                    <td class='adminTable'>$id</td>
                    <td class='adminTable'>$nom</td>";

                    if(isset($_SESSION['login'])){

                        if(isset($_SESSION['role'])) {
                    
                            if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                                $_SESSION['table']='administrateur';
                                 
                                echo "
                              <td>
                               <a href='../Controller/delete.php?id=$id'>delete</a>
                               <a href='../Controller/update.php?id=$id'>update</a>
                                  
                                 </td>
                                 ";
                
                            
                              }
                        }
                    }
                    echo"
                    </form>
                    </td>
                    

                </tr>
                </tbody>
                </table>
                ";

            }

    }

    //judge list
    public function judgeList($judgearbitre) {

        echo <<<__END

            <table class="content-table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                </tr>
                </thead>
                </table>

            __END;

            foreach($judgearbitre as $unJudge){
                $id = $unJudge->getID();
                $nom = $unJudge->getID_membre();

                echo "
                <table class='content-table tableJudge'>
                <tbody>
                <tr>
                    <td>$id</td>
                    <td>$nom</td>";
                    
                    if(isset($_SESSION['login'])){

                        if(isset($_SESSION['role'])) {
                    
                            if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                                $_SESSION['table']='judgearbitre';
                                 
                                echo "
                              <td>
                               <a href='../Controller/delete.php?id=$id'>delete</a>
                               <a href='../Controller/update.php?id=$id'>update</a>
                                  
                                 </td>
                                 ";
                
                            
                              }
                        }
                    }
                    echo"
                    </form>
                    </td>
                    

                </tr>
                </tbody>
                </table>
                ";

            }

    }

    //result list
    public function resultList ($resultsList){

        echo <<<__END

            <table class="content-table ">
                <tr>
                <thead>
                    <th>ID</th>
                    <th>NOM MEMBRE</th>
                    <th>TURNOI ID</th>
                    <th>SCORE</th>
                </tr>
                </thead>
                </table>

        __END;

        foreach($resultsList as $result){
                $id = $result->getId();
                $nom = $result->getID_membre();
                $turnoi = $result-> getID_turnoi();
                $score = $result->getScore();


                echo "
                        <table class='content-table tableResult'>
                        <tbody>
                        <tr>
                            <td>$id</th>
                            <td class='tdResultNom'>$nom</th>
                            <td class='table-center'>$turnoi</th>
                            <td class='table-center'>$score</th>
                ";
    
                if(isset($_SESSION['login'])){

                    if(isset($_SESSION['role'])) {
                
                        if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
                            $_SESSION['table']='participer';
                            
                            echo "
                                <td>
                                <a href='../Controller/delete.php?id=$id'>delete</a>
                                <a href='../Controller/update.php?id=$id'>update</a>    
                                </td>
                                ";

                        
                        }
                    }
                }

                echo "
                        </tr>
                        </tbody>
                        </table>
                        ";

            }
    }

    //resultats list index.php
    public function resultatsListIndex($listIndex) {

        echo '
            <table class="content-table ">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>CLUB</th>
                    <th>CATEGORIE</th>
                    <th>POINTS</th>
                </tr>
            </thead>
            </table>
            ';


            while($row = mysqli_fetch_assoc($listIndex)) {
            
            
                $id = $row['id'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $club = $row['club'];
                $categorie = $row['categorie'];
                $points = $row['points'];

                echo <<<__END
                <table class="content-table tableIndexResult">
                <tbody>
                <tr>
                    <td>$id</td>
                    <td>$nom</td>
                    <td>$prenom</td>
                    <td>$club</td>
                    <td>$categorie</th>
                    <td>$points</th>
                </tr>
                </tbody>
                </table>
                __END;

             }

    }

}

   


?>
