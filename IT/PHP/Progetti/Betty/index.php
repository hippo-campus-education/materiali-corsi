<?php
// Inizializza la sessione
session_start();

// Verifica se utente già logged in, se si redirect alla welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se username vuoto 
    if (empty(trim($_POST["username"]))) {
        $username_err = "Per favore inserisci username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Verifica se la password è vuota
    if (empty(trim($_POST["password"]))) {
        $password_err = "Per favore inserisci la tua password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validazione credenziali
    if (empty($username_err) && empty($password_err)) {
        // Prepara il select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password corretta, inizia nuova sessione
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

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
    }

    // Chiudi connessione DB
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        <h2>Login</h2>
        <p>Inserisci credenziali per fare login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Non hai un account? <a href="register.php">Registrati ora</a>.</p>
        </form>
    </div>
</body>

</html>