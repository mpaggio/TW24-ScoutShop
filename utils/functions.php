<?php

    function isUserLoggedIn(){
        return !empty($_SESSION['email']);
    }

    function uploadImage($path, $image){
        $imageName = basename($image["name"]);
        $fullPath = $path.$imageName;
        
         ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        $maxKB = 500;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }

        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($fullPath)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
            $fullPath = $path.$imageName;
        }

        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $fullPath)){
                $msg.= "Errore nel caricamento dell'immagine. Percorso: ".$fullPath;
            }
            else{
                $result = 1;
                $msg = $imageName;
            }
        }
        return array($result, $msg);
    }
    
    function deleteImage($path, $imageName) {
        // Costruisce il percorso completo del file
        $fullPath = rtrim($path, "/") . "/" . $imageName;

        // Abilita il debug degli errori (opzionale)
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Variabili di ritorno
        $result = 0; // 1 se l'immagine è stata eliminata, 0 altrimenti
        $msg = "";

        // Controlla se il file esiste
        if (file_exists($fullPath)) {
            // Prova a eliminare il file
            if (unlink($fullPath)) {
                $result = 1; // Successo
                $msg = "L'immagine $imageName è stata eliminata correttamente.";
            } else {
                $msg = "Errore durante l'eliminazione dell'immagine $imageName.";
            }
        } else {
            $msg = "L'immagine $imageName non esiste nel percorso specificato.";
        }

        // Restituisce il risultato e il messaggio
        return array($result, $msg);
    }
?>