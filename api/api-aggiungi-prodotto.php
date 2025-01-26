<?php
        
    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";
    
    if (!isUserLoggedIn() || !$_SESSION["venditore"]) {
        header("location: ../home.php");
        die();
    }
    
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
    
    $path = __DIR__ . "/../img/";
    $result = uploadImage($path, $productImage);
    
    if ($result[0]) {
        try {
            $status = $dbh->addProduct($productName, $productCategory, $codice_versione, $productBrand, $productDescription, $productColor, $productSize, $productPrice, $productQuantity, $productDiscount, $result[1]);
            if ($status) {
                $response = array("status" => "success", "message" => "Prodotto inserito correttamente.");
            } else {
                deleteImage($path, $result[1]);
                throw new Exception("Errore nell'inserimento del prodotto.");
            }
        } catch (Exception $e) {
            $response = array("status" => "fail", "message" => $e->getMessage());
        }
    } else {
        $response = array("status" => "fail", "message" => $result[1]);
    }

    header("Content-type: application/json");
    echo json_encode($response);

?>