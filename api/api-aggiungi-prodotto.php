<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    if (!isUserLoggedIn() || $_SESSION["venditore"]) {
        header("location: ../index.php");
        die();
    }
    
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
    $response = array("status" => "fail", "message" => "Errore generico.");

    try {
        $status = $dbh->addProduct($productName, $productCategory, $codice_versione, $productBrand, $productDescription, $productColor, $productSize, $productPrice, $productQuantity, $productDiscount, $productImage["name"]);
        if ($status) {
            $result = uploadImage(UPLOAD_DIR, $productImage);
            if ($result[0]) {
                $response = array("status" => "success", "message" => "Prodotto inserito correttamente.");
            } else {
                throw new Exception("Errore nel caricamento dell'immagine. ".$result[1]);
            }
        } else {
            throw new Exception("Errore nell'inserimento del prodotto.");
        }
    } catch (Exception $e) {
        $response = array("status" => "fail", "message" => $e->getMessage());
        http_response_code(400);
    }

    header("Content-type: application/json");
    echo json_encode($response);
?>