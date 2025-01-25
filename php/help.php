<?php

require_once('bootstrap.php');

$templateParams["titolo"] = "Scout Shop - Aiuto";
$templateParams["js"] = array("../js/help.js");

if ($_SESSION["venditore"]) {
    require('../template/base-venditore.php');
} else {
    require('../template/base.php');
}

?>