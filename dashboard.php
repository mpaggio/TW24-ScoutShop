<?php

    require_once("./php/bootstrap.php");
    require_once("./utils/functions.php");
    
    if (!isUserLoggedIn()) {
        header("Location: ./login.php");
        die();
    } else if (!$_SESSION["venditore"]) {
        header("Location: ./home.php");
        die();
    }
    
    $templateParams["titolo"] = "Scout Shop - Dashboard Venditore";
    $templateParams["js"] = array("./js/venditore.js");
    $templateParams["name"] = "./template/main-venditore.php";
    
    require_once("./template/base-venditore.php");

?>