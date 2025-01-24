<?php

require_once('../php/bootstrap.php');
require_once('../utils/functions.php');

$response = [];

$articoliCasuali = $dbh->getRandomProducts(8);
$articoliPiuVenduti = $dbh->getTopProducts(8);

if(isUserLoggedIn()) {
    $articoliSuggeriti = $dbh->getRecentProducts($_SESSION["email"], 8);
    for($i = 0; $i < count($articoliSuggeriti); $i++) {
        $articoliSuggeriti[$i]["Nome_immagine"] = UPLOAD_DIR.$articoliSuggeriti[$i]["Nome_immagine"];
    }
    $response += ['articoliSuggeriti' => $articoliSuggeriti];
}

for($i = 0; $i < count($articoliCasuali); $i++) {
    $articoliCasuali[$i]["Nome_immagine"] = UPLOAD_DIR.$articoliCasuali[$i]["Nome_immagine"];
}

for($i = 0; $i < count($articoliPiuVenduti); $i++) {
    $articoliPiuVenduti[$i]["Nome_immagine"] = UPLOAD_DIR.$articoliPiuVenduti[$i]["Nome_immagine"];
}

$response += [
    'articoliCasuali' => $articoliCasuali,
    'articoliPiuVenduti' => $articoliPiuVenduti
];



header('Content-Type: application/json');
echo json_encode($response);

?>