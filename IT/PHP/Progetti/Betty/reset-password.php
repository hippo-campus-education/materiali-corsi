<?php
// Inizializza la sessione
session_start();

// Verifica che utente logged in, altrimenti redirect a login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Valida la nuova password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Per favore inserisci nuova password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password deve avere almeno 6 caratteri.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Valida password di conferma
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Per favore conferma la nuova password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password non corrispondono.";
        }
    }

    // Verifica errori di input prima di aggiornare il Database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepara un update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Imposta i parametri
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Password aggiornata con successo. Distruggi sessione e redirect alla login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
            }

            // Chiudi statement
            mysqli_stmt_close($stmt);
        }
    }

    // Chiudi connessione
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Inserisci credenziali per fare reset della tua password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password"
                    class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $new_password; ?>">
                <span class="invalid-feedback">
                    <?php echo $new_password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Invia">
                <a class="btn btn-link ml-2" href="dashboard.php">Annulla</a>
            </div>
        </form>
    </div>
</body>

</html>