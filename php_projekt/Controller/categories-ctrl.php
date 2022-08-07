<?php

require_once '../Model/AccesDB.php';
require_once '../Model/DB_mySqli.php';
require_once '../CoucheMetiers/categorie.php';
require_once 'presentation.php';

$conn =   DB_mySqli::getInstance();
$accessDB= new AccesDB();

if(isset($_SESSION['searchActive'])) {
    if($_SESSION['searchActive']){
        $text =   $_SESSION['textToSearch'];

        if($text !== ''){
            $categories = $accessDB->searchTables($text);
            $presentation = new Presentation();
            $presentation->catdisp($categories);
            $_SESSION['searchActive']=null;
        } else {
            $categories = $accessDB->ListerLesCategories("categorie");
            $presentation = new Presentation();
            $presentation->catdisp($categories);
        } 

    }
} else {

    $categories = $accessDB->ListerLesCategories("categorie");
    $presentation = new Presentation();
    $presentation->catdisp($categories);
}

?>