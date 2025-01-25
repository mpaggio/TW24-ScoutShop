<?php
    session_start();
    
    define("UPLOAD_DIR", "./img/");
    
    // require_once("utils/functions.php");
    define('BASE_PATH', __DIR__ . '/../'); // Percorso assoluto alla radice del progetto
    require_once BASE_PATH . 'db/database.php';
    
    $dbh = new DatabaseHelper("localhost", "root", "", "scoutshopdatabase", 3306);
?>