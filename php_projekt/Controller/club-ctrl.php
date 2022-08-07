<?php

require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
require_once 'presentation.php';

$conn =   DB_mySqli::getInstance();
$access = new AccesDB();

if(isset($_SESSION['searchActive'])) {
    if($_SESSION['searchActive']){
        $text =   $_SESSION['textToSearch'];

        if($text !== ''){
                   
            $result = $access->searchClubTable($text);
            $presentation = new Presentation();
            $presentation->clubList ($result);
            $_SESSION['searchActive']=null;
        } else {
            $result = $access->ListerLesClub();
            $presentation = new Presentation();
            $presentation->clubList ($result);
        } 

    }
} else {

    $result = $access->ListerLesClub();
    $presentation = new Presentation();
    $presentation->clubList ($result);
}

?>