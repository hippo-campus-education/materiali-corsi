<?php

/**
 * config.php - File di configurazione esterno per la connessione al database MySQL.
 *
 * Questo script definisce le credenziali di accesso al database e tenta di
 * stabilire una connessione utilizzando la funzione mysqli_connect().
 *
 */

/**
 * 
 * Sicurezza
 * Utilizzare costanti per le credenziali 
 * del database aiuta a proteggere le informazioni sensibili.
 * Questo rende più difficile per gli attaccanti ottenere accesso alle credenziali
 * direttamente dal codice sorgente.
 * Questo è un file configurazione esterno
 * per non inserire le credenziali direttamente nel codice, 
 * specialmente se il codice è condiviso o pubblicato.
 * Potrebbe essere utile cifrare o proteggere ulteriormente queste
 * informazioni.
 * Sul server inoltre:
 * BASH: chmod 600 config.php
 * Imposta le autorizzazioni del file in modo che sia accessibile 
 * solo dal proprietario e, se necessario, dal gruppo del server web
 * 
 * BASH: chown www-data:www-data config.php
 * Assicura che il proprietario del file sia il proprietario del processo 
 * web o del server web (ad esempio, Apache o Nginx) che esegue lo script PHP
 * sostituire www-data:www-data con utente-gruppo reali
 * 
 * HTACCESS:
 * <Files "config.php">
 *  Order Allow,Deny
 *  Deny from all
 * </Files>
 * 
 * Questo blocca l'accesso diretto al file config.php da parte degli utenti web
 * 
 */

/**
 * 
 * Performance
 * Le costanti sono valori che non cambiano durante l'esecuzione dello
 * script. Utilizzare costanti per le credenziali
 * permette al PHP di ottimizzare l'accesso a queste variabili,
 * migliorando le prestazioni rispetto all'utilizzo di variabili regolari.
 * 
 */

/**
 * 
 * Standard
 * Utilizzare define per definire costanti è una pratica
 * comune e ben accettata nella programmazione PHP.
 * Questo rende il codice più leggibile e manutenibile.
 * 
 */

/**
 * 
 * Documentazione
 * Commentare chiaramente le parti del codice è fondamentale per la documentazione.
 * Le spiegazioni fornite nei commenti aiutano gli sviluppatori
 * a comprendere le decisioni prese e il funzionamento del codice.
 * 
 */


// Definizione delle credenziali del database
define('DB_SERVER', 'localhost'); // Indirizzo del server del database (generalmente 'localhost' se il database è sullo stesso server)
define('DB_USERNAME', 'betty'); // Nome utente per la connessione al database
define('DB_PASSWORD', 'bettybetty'); // Password in chiaro per la connessione al database
//define('DB_PASSWORD', password_hash('bettybetty', PASSWORD_DEFAULT)); // Password cifrata con hash(bcrypt) e saltper la connessione al database
// PASSWORD_DEFAULT indica a password_hash di usare algoritmo di hashing di default ovvero bcrypt
define('DB_NAME', 'betty'); // Nome del database a cui connettersi

// Altre impostazioni del DB:
define('DB_PORT', '3306'); // Porta del database (se diversa da quella predefinita)
define('DB_CHARSET', 'utf8mb4'); // Set di caratteri del database



// Tentativo di connessione al database usando le credenziali definite sopra
//$connessione = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica se la connessione ha avuto successo
//if ($connessione->connect_error) {
//    die("Connessione fallita: " . $connessione->connect_error);
//}

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

// Impostazioni Applicativo
define('BASE_PATH', '/corso-php/progetto-Betty/Betty-1.0');  // Sostituisci con il tuo percorso di base
$titolo_applicazione = "Betty Dashboard";

?>