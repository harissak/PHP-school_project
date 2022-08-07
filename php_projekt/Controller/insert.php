<?php
session_start();




    if(isset($_POST['insert'])) {
      $table = $_SESSION['page'];


      if($table === 'categories') {
            
        header("Location: insert-categorie.php");
            

      } else if($table === 'membre') {
            
        header("Location: insert-membre.php");
            

      } else if($table === 'club') {
            
        header("Location: insert-club.php");
            

      } else if($table === 'administrateur') {
            
        header("Location: insert-judgeAdmin.php");
            

      } else if($table === 'judgearbitre') {
            
        header("Location: insert-judgeAdmin.php");
            

      } else if($table === 'turnoi') {
            
        header("Location: insert-turnoi.php");
            
      }else if($table === 'participer') {
            
        header("Location: insert-result.php");
            
      }


      } 

    
?>