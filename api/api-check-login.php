<?php
require_once('../php/bootstrap.php');
require_once('../utils/functions.php');

header('Content-Type: application/json');

if (isUserLoggedIn()) {
    echo json_encode(['isLoggedIn' => true]);
} else {
    echo json_encode(['isLoggedIn' => false]);
}
?>