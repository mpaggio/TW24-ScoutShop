<?php
    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";

    header('Content-Type: application/json');

    if (isUserLoggedIn()) {
        echo json_encode(['isLoggedIn' => true]);
    } else {
        echo json_encode(['isLoggedIn' => false]);
    }
?>