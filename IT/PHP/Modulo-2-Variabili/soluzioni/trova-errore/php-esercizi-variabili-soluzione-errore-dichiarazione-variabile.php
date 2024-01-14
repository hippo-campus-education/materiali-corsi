<?php
// Dichiarazione delle variabili
$prezzo = 50;
$scontoPercentuale = 10;

// Dichiarazione mancante
$prezzoScontato = $prezzo - ($prezzo * $scontoPercentuale / 100);

// Stampare il risultato
echo "Il prezzo scontato è: " . $prezzoScontato;
?>
