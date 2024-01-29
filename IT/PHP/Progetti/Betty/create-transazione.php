<?php
// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$cliente_id = $tipo_transazione_id = 1;
$data = $ora = $importo = "";
$cliente_id_err = $tipo_transazione_id_err = $data_err = $ora_err = $importo_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida cliente_id
    $input_cliente_id = trim($_POST["cliente_id"]);
    if (empty($input_cliente_id)) {
        $cliente_id_err = "Per favore inserisci cliente_id.";
        /*} elseif (!filter_var($input_client_id, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $client_id_err = "Per favore inserisci client_id valido.";
            */
    } else {
        $cliente_id = $input_cliente_id;
    }

    // Valida data
    $input_data = trim($_POST["data"]);
    if (empty($input_data)) {
        $data_err = "Per favore inserisci data.";
        /*} elseif (!filter_var($input_data, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $data_err = "Per favore inserisci data valida.";*/
    } else {
        $data = $input_data;
    }

    // Valida ora
    $input_ora = trim($_POST["ora"]);
    if (empty($input_ora)) {
        $ora_err = "Per favore inserisci ora.";
    } else {
        $ora = $input_ora;
    }

    // Valida tipo_transazione_id
    $input_tipo_transazione_id = trim($_POST["tipo_transazione_id"]);
    if (empty($input_tipo_transazione_id)) {
        $tipo_transazione_id_err = "Per favore inserisci tipo transazione id.";
        /* } elseif (!filter_var($input_tipo_transazione_id, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
             $tipo_transazione_id_err = "Per favore inserisci client_id valido.";*/
    } else {
        $tipo_transazione_id = $input_tipo_transazione_id;
    }

    // Valida importo
    $input_importo = trim($_POST["importo"]);
    if (empty($input_importo)) {
        $importo_err = "Per favore inserisci importo.";
    } else {
        $importo = $input_importo;
    }

    // Verifica errori di input prima di inserire dati nel DB
    if (empty($cliente_id_err) && empty($data_err) && empty($ora_err) && empty($tipo_transazione_id_err) && empty($importo_err)) {
        // Prepara un insert statement
        $sql = "INSERT INTO transazioni (cliente_id, data, ora, tipo_transazione_id, importo) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "sssss", $param_cliente_id, $param_data, $param_ora, $param_tipo_transazione_id, $param_importo);

            // Imposta parametri
            $param_cliente_id = $cliente_id;
            $param_data = $data;
            $param_ora = $ora;
            $param_tipo_transazione_id = $tipo_transazione_id;
            $param_importo = $importo;

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
    <title>Crea Transazione</title>
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
                    <h2 class="mt-5">Crea Transazione</h2>
                    <p>Per favore compila il modulo ed invialo per aggiungere una transazione al sistema Betty.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Cliente ID</label>
                            <input type="integer" name="cliente_id"
                                class="form-control <?php echo (!empty($cliente_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $cliente_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $cliente_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Data</label>
                            <input type="text" name="data"
                                class="form-control <?php echo (!empty($data_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $data; ?>">
                            <span class="invalid-feedback">
                                <?php echo $data_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Ora</label>
                            <input type="text" name="ora"
                                class="form-control <?php echo (!empty($ora_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $ora; ?>">
                            <span class="invalid-feedback">
                                <?php echo $ora_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Tipo transazione ID</label>
                            <input type="integer" name="tipo_transazione_id"
                                class="form-control <?php echo (!empty($tipo_transazione_id_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $tipo_transazione_id; ?>">
                            <span class="invalid-feedback">
                                <?php echo $tipo_transazione_id_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Importo</label>
                            <input type="text" name="importo"
                                class="form-control <?php echo (!empty($importo_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $importo; ?>">
                            <span class="invalid-feedback">
                                <?php echo $importo_err; ?>
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