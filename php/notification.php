<?php

require_once('bootstrap.php');
require_once('../utils/functions.php');

if(!isUserLoggedIn()) {
    header("location: ../template/login.php");
    exit();
}

$templateParams["titolo"] = "Scout Shop - Notifiche";
$templateParams["js"] = array("../js/notification.js");

if ($_SESSION["venditore"]) {
    require('../template/base-venditore.php');
} else {
    require('../template/base.php');
}


?>