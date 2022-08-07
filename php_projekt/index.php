<?php

session_start();


if(isset($_SESSION['login'])){
    if($_SESSION['login'] === 'ok'){
       
        include('Templates/log-out-header.php');
    } else {

        include('Templates/header-login.php');
    }
   
} else {
    include('Templates/header-login.php');
}

include('Templates/header.php');
include('Controller/membre-view-index.php');



?>