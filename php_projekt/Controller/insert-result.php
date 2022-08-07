<?php


require_once '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';


session_start();
include('../Templates/header-subcat.php');
$accessDB= new AccesDB();
$membreList= $accessDB->selectAll('membre');
$clubList= $accessDB->selectAll('club');
$turnoiList= $accessDB->selectAll('turnoi');
 
 
if(isset($_SESSION['isUpdate'])){
    if($_SESSION['isUpdate']){

       $id=  $_SESSION['id'];
       $result = $accessDB->selectByID('participer', $id);
       
       if(!$result) {
        $conn->close();
        die("No connection to participer table");
        }

        while($row = mysqli_fetch_assoc($result)) {
        
           
                $nom = $row['id_membre'];
                $turnoi = $row['id_turnoi'];
                $score = $row['score'];

                echo
                <<<__END
                    <div class="loginbox">
                        <h3>scrabble</h3>
                
                            <form action="../Controller/requests.php" method="post">  
                   __END;

                 echo'  <select name="id_membre" required>
                    <option selected="selected" value=""}>Select membre</option>'; 
                         while($row = mysqli_fetch_assoc($membreList)){
                            echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']} {$row['prenom']}</option>";
                        }
                 echo '</select>';
                                     
                echo'  <select name="id_turnoi" required>
                            <option selected="selected" value=""}>Select turnoi</option>'; 
                                while($row = mysqli_fetch_assoc($turnoiList)){
                                    echo "<option value='{$row['id']}'>{$row['id']}</option>";
                                }
                echo '</select>';
            
                echo <<<__END
                     <input type="number" name="score" placeholder="Score" value="$score"required>
                     <button type="submit" name="updateResult">Submit</button>
                
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
        '<div class="loginbox">
                    <h3>scrabble</h3>
                
                    <form action="../Controller/requests.php" method="post"> ';
                    
            echo'  <select name="id_membre" required>
                    <option selected="selected" value=""}>Select membre</option>'; 
                    while($row = mysqli_fetch_assoc($membreList)){
                        echo "<option value='{$row['id']}'>{$row['id']} {$row['nom']} {$row['prenom']}</option>";
                        }
            echo '</select>';

            echo'  <select name="id_turnoi" required>
                    <option selected="selected" value=""}>Select turnoi</option>'; 
                        while($row = mysqli_fetch_assoc($turnoiList)){
                            echo "<option value='{$row['id']}'>{$row['id']} {$row['codeTurnoi']}</option>";
                            }
            echo '</select>';
            

            echo '  
                <input type="number" name="score" placeholder="Score" required>
                    <button type="submit" name="insertResult">Submit</button>
                
                    </form>
        </div>
    ';
}
?>