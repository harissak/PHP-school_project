<?php


require_once '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';

session_start();
include('../Templates/header-subcat.php');
$accessDB= new AccesDB();
$categorieList= $accessDB->selectAll('categorie');
$clubList= $accessDB->selectAll('club');
 
if(isset($_SESSION['isUpdate'])){
    if($_SESSION['isUpdate']){

   
       $id=  $_SESSION['id'];
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
            __END;
                   
             echo'  <select name="categorie" >
                     <option selected="selected" value=""}>Select categorie</option>'; 
                    while($row = mysqli_fetch_assoc($categorieList)){
                        echo "<option value='{$row['id']}'>{$row['nom']}</option>";
                    }
            echo '</select>';

            echo'  <select name="codeClub" >
                     <option selected="selected" value=""}>Select club</option>'; 
                    while($row = mysqli_fetch_assoc($clubList)){
                         echo "<option value='{$row['id']}'>{$row['nom']}</option>";
                    }
        echo '</select>';
        
        echo <<<__END
                     <input type="text" name="motDePass" placeholder="Mote de pass" value="$motDePass"required>
                     <input type="number" name="totalPointsSaison" placeholder="Total points saison" value="$totalPointsSaison"required>
                     <input type="email" name="email" placeholder="email" value="$email"required>
                     <button type="submit" name="updateMembre">Submit</button>
                
                    </form>
            </div>
            __END;
           
         }

         $_SESSION['isUpdate']=null;
   } else {
        echo "Error with Session read";
        $_SESSION['isUpdate']=null;
        $_SESSION['id']=null;
    }

} else { 

echo
'   
<div class="loginbox">
    <h3>scrabble</h3>
   
    <form action="../Controller/requests.php" method="post">  
                    <input type="text" name="nom" placeholder="Nom" required> 
                    <input type="text" name="prenom" placeholder="Prenom " required> 
                    <input type="text" name="codePostal" placeholder="Code postal" required> 
                    <input type="text" name="localite" placeholder="Localite" required> 
                    <input type="text" name="rue" placeholder="Rue" required> 
                    <input type="text" name="gsm" placeholder="Gsm" required> 
                    <input type="date" name="dateDeNaissance" placeholder="Date de naissance"  required> 
                    <input type="text" name="serie" placeholder="Serie"  required> ';

                   
          echo'  <select name="categorie" >
                  <option selected="selected" value=""}>Select categorie</option>'; 
                while($row = mysqli_fetch_assoc($categorieList)){
                    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
                }
            echo '</select>';

            echo'  <select name="codeClub" >
                     <option selected="selected" value=""}>Select club</option>'; 
            while($row = mysqli_fetch_assoc($clubList)){
                echo "<option value='{$row['id']}'>{$row['nom']}</option>";
            }
        echo '</select>';

 echo '             
                    <input type="text" name="motDePass" placeholder="Mot de pass" required>
                    <input type="email" name="email" placeholder="email" required>
                    <button type="submit" name="insertMembre">Submit</button>
                
    </form>
</div>';}
?>