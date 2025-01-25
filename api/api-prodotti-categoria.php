<?php

    require_once __DIR__ . "/../php/bootstrap.php";

    if(isset($_GET["Categoria"])) {
        $categoria = $_GET["Categoria"];
    }

    $articoliPerCategoria = $dbh->getProductsFromCategory($categoria);

    for($i = 0; $i < count($articoliPerCategoria); $i++) {
        $articoliPerCategoria[$i]["Nome_immagine"] = UPLOAD_DIR.$articoliPerCategoria[$i]["Nome_immagine"];
    }

    header('Content-Type: application/json');
    echo json_encode($articoliPerCategoria);

?>