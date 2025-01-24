<?php
    
    // Cancella il cookie di sessione
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    // Cancella le variabili di sessione
    session_unset();
        
    // Cancella la sessione corrente  
    session_destroy();
    
    echo "Logout effettuato con successo!";
        
    // Redirect alla pagina di login
    header("location: ../template/login.php");
?>