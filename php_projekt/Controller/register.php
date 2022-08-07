<?php
require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
session_start();
$conn =   DB_mySqli::getInstance();
$accessDB= new AccesDB();
$categorieList= $accessDB->selectAll('categorie');
$clubList= $accessDB->selectAll('club');
 



if(isset($_SESSION['login'])){
    if($_SESSION['login'] === 'ok'){
       
        include('../Templates/header-sub-logout.php');
    } else {

        include('../Templates/header-login-subcat.php');
    }
   
} else {
    include('../Templates/header-login-subcat.php');
}


include('../Templates/header-subcat.php');


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
</div>';

$_SESSION['page']='membre';
$_SESSION['table']='membre';
$_SESSION['role']='member';
?>