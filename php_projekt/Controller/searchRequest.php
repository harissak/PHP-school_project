<?php
require_once '../Model/AccesDB.php';
session_start();

    if(isset($_POST['submit'])) {
      $searchText = $_POST['search'];
      $page = $_SESSION['page'];

      if(isset($_SESSION['page'])){

        $page = $_SESSION['page'];
        $_SESSION['searchActive']=true;
        $_SESSION['textToSearch']= $searchText;

        switch ($page){
            case'categorie':
            
            header("Location: ../View/categories-view.php");
            break;

            case 'membre':
              header("Location: ../View/membre-view.php");
              break;
            case 'club':
              header("Location: ../View/club-view.php");
              break;
            case 'turnoi':
              header("Location: ../View/turnoi-view.php");
              break;
              case 'participer':
                header("Location: ../View/participer-view.php");
                break;
            default:
            echo "nesto nije uredu s search request";

        }

      }
      

    }

    
?>