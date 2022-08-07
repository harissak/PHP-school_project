<?php

session_start();
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
include('../Templates/search.php');
$_SESSION['page']='turnoi';
$_SESSION['table']='turnoi';

if(isset($_SESSION['login'])){

    if(isset($_SESSION['role'])) {

        if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){
            include('../Templates/admin-control.php');
            $_SESSION['page']='turnoi';
        }
    }
}

include('../Controller/turnoi-ctrl.php');

?>