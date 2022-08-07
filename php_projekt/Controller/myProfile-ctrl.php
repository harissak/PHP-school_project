<?php


require_once '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';

include('../Templates/header-subcat.php');
$accessDB = new AccesDB();

 
if(isset($_SESSION['isUpdate'])){

    $id=  $_SESSION['id_admin'];
    $_SESSION['id']=$id;
    $result = $accessDB->selectByID('membre', $id);

    while($row = mysqli_fetch_assoc($result)) {
    
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $codePostal = $row['codePostal'];
        $localite = $row['localite'];
        $rue = $row['rue'];
        $gsm = $row['gsm'];
        $dateDeNaissance = $row['dateDeNaissance'];
        $serie = $row['serie'];
        $categorie = $row['categorie'];
        $codeClub = $row['codeClub'];
        $motDePass = $row['moteDePass'];
        $email = $row['email'];
        $totalPointsSaison = $row['totalPointsSaison'];
       
    }


        if($_SESSION['isUpdate'] && $_SESSION['role']==='admin'){

                echo
            <<<__END
            <div class="loginbox">
                <h3>scrabble</h3>
        
                    <form action="../Controller/requests.php" method="post">  
                    <input type="text" name="nom" placeholder="Nom" value="$nom" required> 
                    <input type="text" name="prenom" placeholder="Prenom" value="$prenom" required> 
                    <input type="text" name="codePostal" placeholder="Code postal" value="$codePostal" required> 
                    <input type="text" name="localite" placeholder="Localite" value="$localite" required> 
                    <input type="text" name="rue" placeholder="Rue" value="$rue" required> 
                    <input type="number" name="gsm" placeholder="GSM" value="$gsm" required> 
                    <input type="text" name="dateDeNaissance" placeholder="Date de naissance" value="$dateDeNaissance" required> 
                    <input type="text" name="serie" placeholder="Serie" value="$serie" required> 
                    <input type="text" name="categorie" placeholder="Nom du categorie" value="$categorie" required> 
                    <input type="text" name="codeClub" placeholder="Nom du club" value="$codeClub" required> 
                    <input type="text" name="motDePass" placeholder="Mote de pass" value="$motDePass"required>
                    <input type="number" name="totalPointsSaison" placeholder="Total points saison" value="$totalPointsSaison"required>
                    <input type="email" name="email" placeholder="email" value="$email"required>
                    <button type="submit" name="updateMembre">Submit</button>
                
                    </form>
            </div>
            __END;
           
         

        } else {

       
            echo
            <<<__END
            <div class="loginbox">
                <h3>scrabble</h3>
        
                    <form action="../Controller/requests.php" method="post">  
                    <input type="text" name="nom" placeholder="Nom" value="$nom" required> 
                    <input type="text" name="prenom" placeholder="Prenom" value="$prenom" required> 
                    <input type="text" name="codePostal" placeholder="Code postal" value="$codePostal" required> 
                    <input type="text" name="localite" placeholder="Localite" value="$localite" required> 
                    <input type="text" name="rue" placeholder="Rue" value="$rue" required> 
                    <input type="number" name="gsm" placeholder="GSM" value="$gsm" required> 
                    <input type="text" name="dateDeNaissance" placeholder="Date de naissance" value="$dateDeNaissance" required> 
                    <input type="text" name="serie" placeholder="Serie" value="$serie" required> 
                    <input type="text" name="categorie" placeholder="Nom du categorie" value="$categorie" required> 
                    <input type="text" name="codeClub" placeholder="Nom du club" value="$codeClub" required> 
                    <input type="text" name="motDePass" placeholder="Mote de pass" value="$motDePass"required>
                    <input type="email" name="email" placeholder="email" value="$email"required>
                    <button type="submit" name="updateMembre">Submit</button>
                
                    </form>
            </div>
            __END;
         
         }
      
    

} else { 
    echo "There is a problem in part of my profile";
        $_SESSION['isUpdate']=null;
        $_SESSION['id']=null;
}
?>