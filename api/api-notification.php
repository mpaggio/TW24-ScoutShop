<?php
    require_once("../php/bootstrap.php");
    
    $notifiche = $dbh->getAllNotifies($_SESSION["email"]);
    
    header("Content-type: application/json");
    echo json_encode($notifiche);
?>