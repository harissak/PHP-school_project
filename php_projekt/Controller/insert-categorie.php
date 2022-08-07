<?php


require_once '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';

session_start();
include('../Templates/header-subcat.php');
$accessDB= new AccesDB();
 
if(isset($_SESSION['isUpdate'])){
    if($_SESSION['isUpdate']){

       $id=  $_SESSION['id'];
      
        $result = $accessDB->selectByID('categorie', $id);

        while($row = mysqli_fetch_assoc($result)) {
        
           
            $maxAge = $row['ageMax'];
            $minAge = $row['ageMin'];
            $nom = $row['nom'];

            echo
            <<<__END
            <div class="loginbox">
                <h3>scrabble</h3>
        
                    <form action="../Controller/requests.php" method="post">  
                    <input type="text" name="nom" placeholder="Nom du categorie" value="$nom" required> 
                    <input type="number" name="ageMin" placeholder="Age minimum" value="$minAge"required>
                    <input type="number" name="ageMax" placeholder="Age maximum" value="$maxAge"required>
                    <button type="submit" name="updateCategorie">Submit</button>
                
                    </form>
            </div>
            __END;
           
         }

         $_SESSION['isUpdate']=null;
   } else {
        echo "problem s ocitavanjem sessije";
        $_SESSION['isUpdate']=null;
        $_SESSION['id']=null;
    }
} else { 
echo
'   
<div class="loginbox">
    <h3>scrabble</h3>
   
    <form action="../Controller/requests.php" method="post">  
    <input type="text" name="nom" placeholder="Nom du categorie" required> 
    <input type="number" name="ageMin" placeholder="Age minimum" required>
    <input type="number" name="ageMax" placeholder="Age maximum" required>
    <button type="submit" name="insertCategorie">Submit</button>
   
    </form>
</div>';}
?>