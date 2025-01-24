<?php
    require_once("../php/bootstrap.php");
    
    $notifiche = $dbh->getAllNotifies("mpaggiojr@gmail.com");
    
    header("Content-type: application/json");
    echo json_encode($notifiche);
?>