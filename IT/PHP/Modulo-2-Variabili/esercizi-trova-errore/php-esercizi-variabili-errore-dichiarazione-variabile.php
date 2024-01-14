<?php
// Dichiarazione delle variabili
$prezzo = 50;
$scontoPercentuale = 10;

// Calcolo del prezzo scontato
$prezzoScontato = $prezzo - ($prezzo * $scontoPercentuale / 100);

// Stampare il risultato
echo "Il prezzo scontato è: " . $prezzoScontato;
?>
