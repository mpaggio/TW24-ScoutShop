<?php

    require_once("./php/bootstrap.php");

    $templateParams["titolo"] = "Scout Shop - Aiuto";
    $templateParams["js"] = array("./js/help.js");

    if (isset($_SESSION["venditore"]) && $_SESSION["venditore"]) {
        require('./template/base-venditore.php');
    } else {
        require('./template/base.php');
    }

?>