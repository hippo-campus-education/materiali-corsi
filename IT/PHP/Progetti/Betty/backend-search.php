<?php
/* Tentativo di connessione al server DB MySQL */

$link = mysqli_connect("localhost", "betty", "betty", "betty");

// Verifica connessione
if ($link === false) {
    die("ERRORE: Non posso connettermi. " . mysqli_connect_error());
}

if (isset($_REQUEST["term"])) {
    // Prepara una select statement
    $sql = "SELECT * FROM clienti WHERE cognome LIKE ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Collega le variabili allo statement preparato come parametro
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Imposta parametri
        $param_term = $_REQUEST["term"] . '%';

        // Tentativo di esecuzione dello statement preparato
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Verifica il numero di righe nel dataset di risposta alla query
            if (mysqli_num_rows($result) > 0) {
                // Carica le righe risultanti in un array associativo
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<p>" . $row["cognome"] . "</p>";
                }
            } else {
                echo "<p>Nessun risultato trovato</p>";
            }
        } else {
            echo "ERRORE: Non sono in grado di eseguire $sql. " . mysqli_error($link);
        }
    }

    // Chiudi statement
    mysqli_stmt_close($stmt);
}

// chiudi connessione
mysqli_close($link);
?>