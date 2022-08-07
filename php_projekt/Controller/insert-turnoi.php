<?php


require_once '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';

session_start();
include('../Templates/header-subcat.php');
$accessDB= new AccesDB();
$membreList= $accessDB->selectAll('membre');
$clubList= $accessDB->selectAll('club');
$categorieList= $accessDB->selectAll('categorie');

if(isset($_SESSION['isUpdate'])){
    if($_SESSION['isUpdate']){

       $id=  $_SESSION['id'];
       $result = $accessDB->selectByID('turnoi', $id);


        while($row = mysqli_fetch_assoc($result)) {
        
           
            $dtt = $row['dtturnoi'];
            $codeTurnoi = $row['turnoiCode'];
            $nomCat = $row['nomCategorie'];
            $codeClub = $row['codeClub'];

            echo
                <<<__END
                    <div class="loginbox">
                        <h3>scrabble</h3>
                
                        <form action="../Controller/requests.php" method="post">   
                        <input type="text" name="turnoiCode" placeholder="Code turnoi"  value="$codeTurnoi" required>
                        <input type="date" name="dtturnoi" placeholder="Date de turnoi"  value="$dtt" required>
                  __END;
    
            echo'  <select name="codeClub" required>
                <option selected="selected" value=""}>Select club</option>'; 
                     while($row = mysqli_fetch_assoc($clubList)){
                         echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']} </option>";
                      }
            echo '</select>';
            
            echo'  <select name="nomCategorie" required>
                  <option selected="selected" value=""}>Select vategorie</option>'; 
                     while($row = mysqli_fetch_assoc($categorieList)){
                           echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']}</option>";
                        }
            echo '</select>';
            
            
                
            echo
                <<<__END
                       <button type="submit" name="updateTurnoi">Submit</button>
                
                
                        </form>
                   </div>
              __END;
           
         }

         $_SESSION['isUpdate']=null;
   } else {
        echo "Error read session turnoi";
        $_SESSION['isUpdate']=null;
        $_SESSION['id']=null;
    }
} else { 
echo
'   
<div class="loginbox">
    <h3>scrabble</h3>
   
    <form action="../Controller/requests.php" method="post">  
    <input type="text" name="turnoiCode" placeholder="Code turnoi"  required>
    <input type="date" name="dtturnoi" placeholder="Date de turnoi" required>';
    
    echo'  <select name="codeClub" required>
    <option selected="selected" value=""}>Select club</option>'; 
    while($row = mysqli_fetch_assoc($clubList)){
        echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']} </option>";
        }
echo '</select>';

echo'  <select name="nomCategorie" required>
    <option selected="selected" value=""}>Select categorie</option>'; 
        while($row = mysqli_fetch_assoc($categorieList)){
            echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']}</option>";
            }
echo '</select>';


    
echo'    <button type="submit" name="insertTurnoi">Submit</button>
   
    </form>
</div>';}

?>