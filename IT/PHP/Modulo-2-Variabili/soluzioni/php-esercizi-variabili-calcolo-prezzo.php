<?php
// Dichiarazione delle variabili
$prezzo = 100; // Assegno il prezzo originale
$scontoPercentuale = 20; // Assegno la percentuale di sconto

// Calcolo del prezzo scontato
$prezzoScontato = $prezzo - ($prezzo * $scontoPercentuale / 100); // Utilizzo la formula di sconto

// Stampare i risultati
echo "Il prezzo originale è: $" . $prezzo . "<br>"; // Mostro il prezzo originale
echo "Il prezzo scontato è: $" . $prezzoScontato; // Mostro il prezzo scontato
?>
