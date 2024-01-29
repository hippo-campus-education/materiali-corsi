<?php
// Inizializza la sessione
session_start();

// Annulla impostazioni di tutte le variabili di sessione
$_SESSION = array();

// Distrugge la sessione.
session_destroy();

// Redirect alla login page
header("location: login.php");
exit;
?>