<?php
// Verifica che parametro id esista prima di procedere oltre
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepara un select statement
    $sql = "SELECT * FROM clienti WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Collega le variabili allo statement preparato come parametro
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Imposta parametri
        $param_id = trim($_GET["id"]);

        // Tentativo di esecuzione dello statement preparato
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Carica le righe risultato in un array associativo. Una riga sola, non serve loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Recupera i valori dei singoli campi della tabella clienti
                $nome = $row["nome"];
                $cognome = $row["cognome"];
                $telefono = $row["telefono"];
            } else {
                // URL non contiene un parametro id valido. Redirect alla error page
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
    // URL non contiene un parametro id valido. Redirect alla error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Visualizza Cliente</title>
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
                    <h1 class="mt-5 mb-3">Visualizza Cliente</h1>
                    <div class="form-group">
                        <label>Nome</label>
                        <p><b>
                                <?php echo $row["nome"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Cognome</label>
                        <p><b>
                                <?php echo $row["cognome"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <p><b>
                                <?php echo $row["telefono"]; ?>
                            </b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Indietro</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>