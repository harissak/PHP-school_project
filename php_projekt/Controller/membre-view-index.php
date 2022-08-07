<?php

    require_once 'Model\AccesDB.php';
    require_once 'View\presentation.php';


    $conn = new AccesDB();
    $result = $conn->resultatsListIndex();
    $presentation = new Presentation();
    $presentation->resultatsListIndex($result);
?>