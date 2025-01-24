<?php

require_once('bootstrap.php');
require_once('../utils/functions.php');

if(!isUserLoggedIn()) {
    header("location: ../template/login.php");
    exit();
}

$templateParams["titolo"] = "Scout Shop - Profilo";
$templateParams["js"] = array("../js/profilo-compratore.js");

require('../template/base.php');

?>