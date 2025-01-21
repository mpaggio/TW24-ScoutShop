<?php
    session_start();
    
    define("UPLOAD_DIR", "../img/");
    
    // require_once("utils/functions.php");
    require_once("../db/database.php");
    
    $dbh = new DatabaseHelper("localhost", "root", "", "scoutshopdatabase", 3306);
    
    $dbh->insertProductInCart("mpaggiojr@gmail.com", "000001", "_0_XL", 10);
    foreach ($dbh->getUserProductsInCart("mpaggiojr@gmail.com") as $product) {
        echo $product["Di_Codice_prodotto"];
        echo $product["Quantita_"];
        echo "<br>";
    }

    $dbh->updateProductQuantityInCart("mpaggiojr@gmail.com", "000001", "_0_XL", 16);
    foreach ($dbh->getUserProductsInCart("mpaggiojr@gmail.com") as $product) {
        echo $product["Di_Codice_prodotto"];
        echo $product["Quantita_"];
        echo "<br>";
    }
?>