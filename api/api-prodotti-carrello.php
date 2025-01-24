<?php

    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php")

    if (isUserLoggedIn()) {
        $templateParams["titolo"] = "Scout Shop - Carrello";
        $templateParams["js"] = array("../js/carrello.js");
        require('../template/base.php');
    } else {
        header("Location: login.php");
        exit;
    }
    
?>