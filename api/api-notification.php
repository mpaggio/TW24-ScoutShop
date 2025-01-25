<?php
    require_once("../php/bootstrap.php");
    
    $notifiche = $dbh->getAllNotifies($_SESSION["email"], !$_SESSION["venditore"]);

    header("Content-type: application/json");

    if (isset($_POST["action"]) && $_POST["action"] === 'leggiTutto'){
        $result = $dbh->updateAllNotify($_SESSION["email"], !$_SESSION["venditore"]);
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Errore nel segnare le notifiche come lette']);
        }
        exit();
    }

    if (isset($_POST["id_notifica"])) {
        $idNotifica = $_POST["id_notifica"];
        $result = $dbh->deleteNotify($idNotifica, !$_SESSION["venditore"]);
        if ($result) {
            echo json_encode(['status' => 'success', 'isVenditore' => $_SESSION["venditore"]]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Errore nell\'eliminazione della notifica', 'isVenditore' => $_SESSION["venditore"]]);
        }
        exit();
    }

    if (isset($_POST["view"])) {
        $idNotifica = $_POST["view"];
        $result = $dbh->updateNotify($idNotifica, !$_SESSION["venditore"]);
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Errore nella visualizzazione della notifica']);
        }
        exit();
    }


    if (isset($_POST["count"])) {
        $result = $dbh->countNotifyToRead($_SESSION["email"], !$_SESSION["venditore"]);
        echo json_encode(['result' => $result]);
        exit();
    }


    
    echo json_encode($notifiche);
?>