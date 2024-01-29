<?php
/**
 * config.php - File di configurazione per la connessione al database MySQL.
 *
 * Questo script definisce le credenziali di accesso al database e tenta di
 * stabilire una connessione utilizzando la funzione mysqli_connect().
 *
 */

// Definizione delle credenziali del database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'betty');
define('DB_PASSWORD', 'bettybetty');
define('DB_NAME', 'betty');

/**
 * Tentativo di connessione al database MySQL.
 *
 * La funzione mysqli_connect() restituirà un oggetto di connessione se
 * la connessione ha successo e false in caso di errore.
 */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica della connessione
if ($link === false) {
    // Se la connessione fallisce, termina lo script mostrando un messaggio di errore.
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// La connessione al database è stata stabilita con successo a questo punto.
// Ora è possibile utilizzare $link per eseguire query e interagire con il database.

// Nota aggiuntiva:
// Buona pratica chiudere la connessione una volta terminato l'uso.
// mysqli_close($link);

?>