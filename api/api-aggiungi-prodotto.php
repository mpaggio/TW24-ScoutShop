<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    // if (!isUserLoggedIn() || !isset($_SESSION["venditore"])) {
    //     header("location: ../index.php");
    //     die();
    // }
    
    // // Per debuggare
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productBrand = $_POST['productBrand'];
    $productColor = $_POST['productColor'];
    $productSize = $_POST['productSize'];
    $productPrice = (float) $_POST['productPrice'];  // Assicurati che sia un numero decimale
    $productQuantity = (int) $_POST['productQuantity'];  // Assicurati che sia un intero
    $productDiscount = (float) $_POST['productDiscount'];  // Assicurati che sia un numero decimale
    $productDescription = $_POST['productDescription'];
    $productImage = $_FILES['productImage'];

    // Crea il codice versione
    $codice_versione = "_".$productColor."_".$productSize;
    
    try {
        $dbh->addProduct($productName, $productCategory, $codice_versione, $productBrand, $productDescription, $productColor, $productSize, $productPrice, $productQuantity, $productDiscount, $productImage["name"]);
        $result = uploadImage(UPLOAD_DIR, $productImage);
        if ($result[0]) {
            $response = array("status" => "success");
        } else {
            throw new Exception("Errore nel caricamento dell'immagine. ".$result[1]);
        }
    } catch (Exception $e) {
        $response = array("status" => "fail", "message" => $e->getMessage());
    }

    // if ($dbh->addProduct($newCode, $productName, $productCategory, $codice_versione, $productBrand, $productDescription, $productColor, $productSize, $productPrice, $productQuantity, $productDiscount, $productImage["name"])) {
    //     // Se l'inserimento va a buon fine, procedi con il caricamento dell'immagine
    //     $response = array("status" => "success");
    // } else {
    //     $response = array("status" => "fail", "message" => "Errore nell'inserimento del prodotto.");
    // }

    header("Content-type: application/json");
    echo json_encode($response);
?>