Colorazioni:
- #BCD5E7 (chiaro)
- #21295C (scuro)
- #0000B6 (link premuto)

Sito per design logo:
- https://it.freelogodesign.org/

Controllo contrasto colori e accessibilità:
- https://accessible-colors.com/
- https://coolors.co/



Appunti:
- Dentro l'href dell'immagine ci va messo il riferimento ad una pagina index.php che dovrà gestire se si tratta di utente loggato o no.
- Dentro al file NON-TEMPLATE ci va:
    - Require di bootstrap (cosi puoi usare $dbh)
    - Definizione del template (titolo, file javascript)
    - Require della base.php
- Dentro al file JAVASCRIPT ci va:
    - Genera il contenuto del main facendosi restituire le cose dall'API
- Dentro al file API:
    - Require di bootstrap (cosi puoi usare $dbh)
    - Interroghi il database e se ti serve pulisci i dati
    - Crei il file json da mandare a javascript 