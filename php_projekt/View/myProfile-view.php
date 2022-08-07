<?php
session_start();
$_SESSION['page']= 'membre';
$_SESSION['table']= 'membre';
$_SESSION['isUpdate'] = true;
include('../Controller/myProfile-ctrl.php');

?>