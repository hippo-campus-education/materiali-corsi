<?php
// Include config file
require_once "config.php";

// Definizione variabili e le inizializza con valori vuoti
$nome = $cognome = $telefono = "";
$nome_err = $cognome_err = $telefono_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Valida nome
    $input_nome = trim($_POST["nome"]);
    if (empty($input_nome)) {
        $nome_err = "Per favore inserisci nome.";
    } elseif (!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nome_err = "Per favore inserisci nome valido.";
    } else {
        $nome = $input_nome;
    }

    // Valida cognome
    $input_cognome = trim($_POST["cognome"]);
    if (empty($input_cognome)) {
        $cognome_err = "Per favore inserisci cognome.";
    } elseif (!filter_var($input_cognome, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $cognome_err = "Per favore inserisci cognome valido.";
    } else {
        $cognome = $input_cognome;
    }

    // Valida telefono
    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono_err = "Per favore inserisci numero di telefono";
    } else {
        $telefono = $input_telefono;
    }

    // Verifica errori di input prima di inserire dati nel DB
    if (empty($nome_err) && empty($cognome_err) && empty($telefono_err)) {
        // Prepara un update statement
        $sql = "UPDATE clienti SET nome=?, cognome=?, telefono=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "sssi", $param_nome, $param_cognome, $param_telefono, $param_id);

            // Imposta parametri
            $param_nome = $nome;
            $param_cognome = $cognome;
            $param_telefono = $telefono;
            $param_id = $id;

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Cliente aggiornato con successo. Redirect alla landing page
                header("location: index.php");
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
} else {
    // Verifica esistenza parametro id prima di procedere oltre
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepara una select statement
        $sql = "SELECT * FROM clienti WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Imposta parametri
            $param_id = $id;

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Carica risultato query in array associativo. Unica riga, non serve loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Recupera i valori dei singoli campi
                    $nome = $row["nome"];
                    $cognome = $row["cognome"];
                    $telefono = $row["telefono"];
                } else {
                    // URL non contiene un id valido. Redirect alla error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
            }
        }

        // Chiudi statement
        mysqli_stmt_close($stmt);

        // Chiudi connessione
        mysqli_close($link);
    } else {
        // URL non contiene un parametro id. Redirect alla error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aggiorna Cliente</title>
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
                        <a class="nav-link" href="tipo_transazioni.php">Tipi Transazioni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolios.php">Portafogli</a>
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
                    <h2 class="mt-5">Aggiorna Cliente</h2>
                    <p>Per favore modifica i dati ed inviali per aggiornare il database di Betty.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome"
                                class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $nome; ?>">
                            <span class="invalid-feedback">
                                <?php echo $nome_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Cognome</label>
                            <input type="text" name="cognome"
                                class="form-control <?php echo (!empty($cognome_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $cognome; ?>">
                            <span class="invalid-feedback">
                                <?php echo $cognome_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email"
                                class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $email; ?>">
                            <span class="invalid-feedback">
                                <?php echo $email_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" name="telefono"
                                class="form-control <?php echo (!empty($telefono_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $telefono; ?>">
                            <span class="invalid-feedback">
                                <?php echo $telefono_err; ?>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Invia">
                        <a href="index.php" class="btn btn-secondary ml-2">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>