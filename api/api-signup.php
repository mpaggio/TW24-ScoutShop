<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");

    if (isUserLoggedIn()) {
        header("location: ../php/home.php");
        die();
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $nome = trim($_POST["signupName"]);
    $cognome = trim($_POST["signupSurname"]);
    $email = trim($_POST["signupEmail"]);
    $password = trim($_POST["signupPassword"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $response = [];
    
    try {
        $result = $dbh->createAccount($email, $hashedPassword, $nome, $cognome);
        $_SESSION["email"] = $email;
        $_SESSION["venditore"] = false;
        http_response_code(201); // 201 Created
        $response = ["status" => "success", "message" => "Registrazione completata con successo."];
    } catch (Exception $e) {
        if ($e->getMessage() === "USER_EXISTS") {
            http_response_code(409); // 409 Conflict
            $response = ["status" => "error", "message" => "Email già registrata."];
        } elseif ($e->getMessage() === "INSERT_FAILED") {
            http_response_code(500); // 500 Internal Server Error
            $response = ["status" => "error", "message" => "Errore durante la registrazione."];
        }
    }

    header("Content-type: application/json");
    echo json_encode($response);
?>