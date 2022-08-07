
<?php

include '../Model/DB_mySqli.php';
require_once '../Model/AccesDB.php';
session_start();

$connection = new AccesDB();
$check= DB_mySqli::getInstance();


    if(isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password']; 
      
      $username = mysqli_real_escape_string($check, $username);
      $password = mysqli_real_escape_string($check, $password);

      $select_user_query = $connection->selectMembreByEmail($username);
      if (!isset($_SESSION['id_admin'])) {
        echo"Login data doesn't exist in datapase";
     } else {  
        $queryAdmin= $connection->adminData('administrateur',$_SESSION['id_admin']);
        if(!$queryAdmin){

          die("QUERY FAILED SELECT ADMIN");
  
        }
     }
     

      if(!$select_user_query ){

        die("QUERY FAILED SELECT MEMBRE");

      }

      


      if($username !==  $_SESSION['email'] || $password !== $_SESSION['motDePass']) {
            
        header("Location: ../View/login-view.php");
            

      } else {
        $_SESSION['login']='ok';
        

        if($_SESSION['id_admin']=== $_SESSION['admin_id']){
          $_SESSION['role']= 'admin';
          header("Location: ../index.php");
          

        } else {
          $_SESSION['role']= 'membre';
          header("Location: ../index.php");
          
          }

       
      }
    }

    
?>