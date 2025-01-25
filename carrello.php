<?php

    require_once("./php/bootstrap.php");
    require_once("./utils/functions.php");

    if (!isUserLoggedIn()) {
        header("Location: ./login.php");
        die();
    }

    $templateParams["titolo"] = "Scout Shop - Carrello";
    $templateParams["js"] = array("./js/carrello.js");

    require('./template/base.php');

?>