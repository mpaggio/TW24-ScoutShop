<?php
    require_once __DIR__ . '/../php/bootstrap.php';
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data["search"])) {
        $text = $data["search"];
        $articles = $dbh->getProductsFromSearch($text);
    } else {
        $articles = $dbh->getProductVerions();
    }
    
    for($i = 0; $i < count($articles); $i++) {
        $articles[$i]["Nome_immagine"] = UPLOAD_DIR.$articles[$i]["Nome_immagine"];
    }
    
    header("Content-type: application/json");
    echo json_encode($articles);
?>