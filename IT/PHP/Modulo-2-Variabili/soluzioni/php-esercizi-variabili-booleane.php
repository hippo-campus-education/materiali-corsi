<?php
// Dichiarazione delle variabili booleane
$utenteLoggato = true;
$haAccessoPremium = false;

// Verifica dello stato delle variabili
if ($utenteLoggato) {
    echo "L'utente è loggato. ";
    
    if ($haAccessoPremium) {
        echo "L'utente ha accesso a contenuti premium.";
    } else {
        echo "L'utente non ha accesso a contenuti premium.";
    }
} else {
    echo "L'utente non è loggato.";
}
?>
