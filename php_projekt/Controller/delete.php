<?php require_once '../Model/AccesDB.php'; ?>

<?php
session_start();

$id='';


if(!empty($_GET['id'])) {

    $id=$_GET['id'];

    $table = $_SESSION['table'];
    
    $delete = new AccesDB();
    $_SESSION['id']=null;
    $_SESSION['table']=null;

    $toDelete= true;

    if($table === 'administrateur' || $table === 'judgearbitre') {

        $count = $delete->countRows($table);

         if ($count < 2)  {
            $toDelete= false;
            echo "It is not possible to delete last member from table";
          
        }    
     }


   if($toDelete) {
        $delete->deleteFromTable($id,$table);

        if($delete) {
            switch ($table) {

                case 'categorie':
                header("Location: ../View/categories-view.php");
                break;

                case 'club':
                header("Location: ../View/club-view.php");
                    break;
                case 'membre':
                    header("Location: ../View/membre-view.php");
                    break;
                case 'turnoi':
                    header("Location: ../View/turnoi-view.php");
                    break;
                case 'administrateur':
                    header("Location: ../View/administration-view.php");
                        break;
                case 'judgearbitre':
                    header("Location: ../View/administration-view.php");
                        break; 
                case 'participer':
                    header("Location: ../View/participer-view.php");
                        break;             

                default:
                echo" Something went wrong";
                }

        }
    }


} else {
    echo "GET METHOD empty";
}

?>