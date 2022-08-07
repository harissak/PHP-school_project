<?php
require_once '../Model/AccesDB.php';

$accessDB= new AccesDB();
$startSeason = $accessDB->startNewSeason();

if($startSeason) {
    header("Location: ../index.php");
}


?>