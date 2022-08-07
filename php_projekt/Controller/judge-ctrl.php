<?php

require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
require_once 'presentation.php';

$conn =   DB_mySqli::getInstance();
$accessDB= new AccesDB();
$judge = $accessDB->ListerLesJudgearbitre();
$presentation = new Presentation();
$presentation->judgeList($judge);

?>