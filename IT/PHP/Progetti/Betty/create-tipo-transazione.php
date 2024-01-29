<?php
// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$movimento = $tipo_transazione = "";
$movimento_err = $tipo_transazione_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida movimento
    $input_movimento = trim($_POST["movimento"]);
    if (empty($input_movimento)) {
        $movimento_err = "Per favore inserisci nome.";
    } elseif (!filter_var($input_movimento, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $movimento_err = "Per favore inserisci nome valido.";
    } else {
        $movimento = $input_movimento;
    }

    // Valida tipo transazione
    $input_tipo_transazione = trim($_POST["tipo_transazione"]);
    if (empty($input_tipo_transazione)) {
        $tipo_transazione_err = "Per favore inserisci tipo transazione.";
    } /*elseif (!filter_var($input_tipo_transazione, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
       $tipo_transazione_err = "Per favore inserisci tipo valido.";
   }*/else {
        $tipo_transazione = $input_tipo_transazione;
    }


    // Verifica errori di input prima di inserire dati nel DB
    if (empty($movimento_err) && empty($tipo_transazione_err)) {
        // Prepara un insert statement
        $sql = "INSERT INTO tipi_transazioni (movimento, tipo_transazione) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "ss", $param_movimento, $param_tipo_transazione);

            // Imposta parametri
            $param_movimento = $movimento;
            $param_tipo_transazione = $tipo_transazione;


            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Cliente creato con successo. Redirect alla landing page
                header("location: dashboard.php");
                exit();
            } else {
                echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
            }
        }

        // Chiudi statement
        mysqli_stmt_close($stmt);
    }

    // Chiudi connessione
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crea Tipo Transazione</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="container">
                <h2>Dashboard</h2>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Clienti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transazioni.php">Transazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tipi_transazioni.php">Tipi Transazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="liste_clienti.php">Liste Clienti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search-form.php">Ricerca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reset-password.php">Reset Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crea Tipo Transazione</h2>
                    <p>Per favore compila il modulo ed invialo per aggiungere un tipo transazione al sistema Betty.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Movimento</label>
                            <input type="text" name="movimento"
                                class="form-control <?php echo (!empty($movimento_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $movimento; ?>">
                            <span class="invalid-feedback">
                                <?php echo $movimento_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Tipo Transazione</label>
                            <input type="text" name="tipo_transazione"
                                class="form-control <?php echo (!empty($tipo_transazione_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $tipo_transazione; ?>">
                            <span class="invalid-feedback">
                                <?php echo $tipo_transazione_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Invia">
                        <a href="index.php" class="btn btn-secondary ml-2">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>