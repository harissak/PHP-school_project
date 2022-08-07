<?php

require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
require_once 'presentation.php';


$conn =   DB_mySqli::getInstance();
$accessDB= new AccesDB();

$admin= $accessDB->ListerLesAdministrateurs();
$presentation = new Presentation();
$presentation->adminList($admin);



?>