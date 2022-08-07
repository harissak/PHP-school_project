<?php
session_start();


$_SESSION['isUpdate']=true;

if(!empty($_GET['id'])) {
    

    $_SESSION['id']=$_GET['id'];

    if($_SESSION['table']==='categorie'){
        header("Location: insert-categorie.php");

    } else if($_SESSION['table']==='membre'){
        header("Location: insert-membre.php");

    }else if($_SESSION['table']==='club'){
        header("Location: insert-club.php");

    }else if($_SESSION['table']==='turnoi'){
        header("Location: insert-turnoi.php");

    }else if($_SESSION['table']==='participant'){
        header("Location: insert-participant.php");

    }else if($_SESSION['table']==='administrateur'){
        header("Location: insert-judgeAdmin.php");
        $_SESSION['admin-judge']='administrateur';

    }else if($_SESSION['table']==='judgearbitre'){
        header("Location: insert-judgeAdmin.php");
        $_SESSION['admin-judge']='judgearbitre';

    } else if($_SESSION['table']==='participer'){
        header("Location: insert-result.php");

    }else {
        echo "UPDATE TABLE DOES NOT EXIST";
    }



} else {
    echo "GET METHOD UPDATE empty";
}

?>