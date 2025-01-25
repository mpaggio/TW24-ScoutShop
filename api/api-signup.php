<?php

    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";

    if (isUserLoggedIn()) {
        header("location: ../home.php");
        die();
    }

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
        $response = ["status" => "success", "message" => "Registrazione completata con successo."];
    } catch (Exception $e) {
        if ($e->getMessage() === "USER_EXISTS") {
            $response = ["status" => "error", "message" => "Email già registrata."];
        } elseif ($e->getMessage() === "INSERT_FAILED") {
            $response = ["status" => "error", "message" => "Errore durante la registrazione."];
        }
    }

    header("Content-type: application/json");
    echo json_encode($response);
    
?>