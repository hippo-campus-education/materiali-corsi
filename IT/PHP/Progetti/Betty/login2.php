// Prepara il select statement
$sql = "SELECT id, username, password, telefono, citta, agenzia_id FROM users WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
// Collega le variabili allo statement preparato come parametro
mysqli_stmt_bind_param($stmt, "s", $param_username);

// Imposta i parametri
$param_username = $username;

// Tentativo di esecuzione dello statement preparato
if (mysqli_stmt_execute($stmt)) {
// Salva risultato query
mysqli_stmt_store_result($stmt);

// Verifica se username esiste nel DB, se si verifica password
if (mysqli_stmt_num_rows($stmt) == 1) {
// Collega le variabili risultato
mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $telefono, $citta, $agenzia_id);
if (mysqli_stmt_fetch($stmt)) {
if (password_verify($password, $hashed_password)) {
// Password corretta, inizia nuova sessione
session_start();

// Store data in session variables
$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;
$_SESSION["telefono"] = $telefono;
$_SESSION["citta"] = $citta;
$_SESSION["agenzia_id"] = $agenzia_id;

// Redirect utente alla welcome page
header("location: dashboard.php");
} else {
// Password non valida, mostra messaggio errore
$login_err = "Invalid username or password.";
}
}
} else {
// Username non esiste, mostra messaggio errore
$login_err = "Invalid username or password.";
}
} else {
echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
}

// Chiudi statement
mysqli_stmt_close($stmt);
}