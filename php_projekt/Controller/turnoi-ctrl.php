<?php
require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
require_once 'presentation.php';

$conn =   DB_mySqli::getInstance();
$accessDB= new AccesDB();


if(isset($_SESSION['searchActive'])) {
    if($_SESSION['searchActive']){
        $text =   $_SESSION['textToSearch'];

        if($text !== ''){
            $result = $accessDB->searchTurnoiTable($text);
            $presentation = new Presentation();
            $presentation->turnoiList ($result);
            $_SESSION['searchActive']=null;
        } else {
            $turnoi = $accessDB->ListerLesTurnoi();
            $presentation = new Presentation();
            $presentation->turnoiList($turnoi);

        } 

    }
} else {

    $turnoi = $accessDB->ListerLesTurnoi();
    $presentation = new Presentation();
    $presentation->turnoiList($turnoi);

}


?>