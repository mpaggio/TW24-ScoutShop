<?php

    require_once("./php/bootstrap.php");
    require_once("./utils/functions.php");

    if(!isUserLoggedIn()) {
        header("location: ./login.php");
        exit();
    }

    $templateParams["titolo"] = "Scout Shop - Profilo";
    $templateParams["js"] = array("./js/profilo-compratore.js");

    require('./template/base.php');

?>