<?php

    require_once("./php/bootstrap.php");

    if (isset($_GET["Categoria"])) {
        $categoria = $_GET["Categoria"];
    }

    $templateParams["titolo"] = "Scout Shop - ".$categoria;
    $templateParams["js"] = array("./js/prodotti-categoria.js");

    require('./template/base.php');

?>