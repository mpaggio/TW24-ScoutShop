<?php
    session_start();
    
    define("UPLOAD_DIR", "../img/");
    
    // require_once("utils/functions.php");
    require_once("../db/database.php");
    
    $dbh = new DatabaseHelper("localhost", "root", "", "scoutshopdatabase", 3306);
    
    foreach ($dbh->getUserOrders("orazio.spina@studio.unibo.it", 0) as $order) {
        echo $order["Codice_ordine"];
        echo "<br>";
    }
?>