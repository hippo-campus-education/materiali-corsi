<?php
// Elabora operazione di cancellazione dopo la conferma
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";

    // Prepara un delete statement
    $sql = "DELETE FROM clienti WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Collega le variabili allo statement preparato come parametro
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Imposta i parametri
        $param_id = trim($_POST["id"]);

        // Tentativo di esecuzione dello statement preparato
        if (mysqli_stmt_execute($stmt)) {
            // Cliente cancellato con successo. Redirect alla landing page
            header("location: dashboard.php");
            exit();
        } else {
            echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
        }
    }

    // Chiudi statement
    mysqli_stmt_close($stmt);

    // Chiudi connessione
    mysqli_close($link);
} else {
    // Verifica esistenza parametro id
    if (empty(trim($_GET["id"]))) {
        // URL non contiene parametro id. Redirect alla error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Elimina Cliente</title>
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
                    <h2 class="mt-5 mb-3">Elimina Cliente</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Sei sicuro di voler eliminare questo cliente?</p>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>