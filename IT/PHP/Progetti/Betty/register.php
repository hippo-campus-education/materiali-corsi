<?php
// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Per favore inserisci username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username puo contenere solo lettere, numeri e underscores.";
    } else {
        // Prepara il select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Imposta i parametri
            $param_username = trim($_POST["username"]);

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Salva risultato query
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Questo username esiste gia.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! SELECT - Qualcosa andato storto. Riprova piu tardi.";
            }

            // Chiudi statement
            mysqli_stmt_close($stmt);
        }
    }

    // Valida password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Per favore inserisci password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password deve avere almeno 6 caratteri.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Valida password di conferma
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Conferma la password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password non corrispondono.";
        }
    }

    // Verifica errori di input prima di inserire dati nel Database
    if (
        empty($username_err) && empty($password_err) && empty($confirm_password_err)
    ) {

        // Prepara un insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Imposta i parametri
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crea un hash per password

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Redirect alla login page
                header("location: login.php");
            } else {
                echo "Oops! INSERT - Qualcosa andato storto. Riprova piu tardi.";
                echo ("Error description: " . mysqli_error($link));
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
    <title>Registrati</title>
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
        <h2>Registrati</h2>
        <p>Per favore compila il modulo per creare un account.</p>
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
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $password; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Conferma Password</label>
                <input type="password" name="confirm_password"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Invia">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Hai gia un account? <a href="login.php">Fai Login</a>.</p>
        </form>
    </div>
</body>

</html>