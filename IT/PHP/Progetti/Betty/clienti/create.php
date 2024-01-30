<?php
// Include config file
require_once("../config.php");

// Definizione variabili e le inizializza con valori vuoti
$nome = $cognome = $email = $telefono = "";
$nome_err = $cognome_err = $email_err = $telefono_err = "";

// Elaborazione dati modulo quando il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Valida email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Per favore inserisci email.";
    } /* elseif (!filter_var($input_email, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
      $email_err = "Per favore inserisci email valido.";
  } */else {
        $email = $input_email;
    }

    // Valida telefono
    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono_err = "Per favore inserisci numero di telefono";
    } else {
        $telefono = $input_telefono;
    }

    // Verifica errori di input prima di inserire dati nel DB
    if (empty($nome_err) && empty($cognome_err) && empty($email_err) && empty($telefono_err)) {
        // Prepara un insert statement
        $sql_cliente = "INSERT INTO clienti (cognome, nome, email, telefono) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql_cliente)) {
            // Collega le variabili allo statement preparato come parametro
            mysqli_stmt_bind_param($stmt, "ssss", $param_cognome, $param_nome, $param_email, $param_telefono);

            // Imposta parametri
            $param_nome = $nome;
            $param_cognome = $cognome;
            $param_email = $email;
            $param_telefono = $telefono;

            // Tentativo di esecuzione dello statement preparato
            if (mysqli_stmt_execute($stmt)) {
                // Cliente creato con successo. Redirect alla landing page
                header("location: ../dashboard.php");
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
    <title>Crea Cliente</title>
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
                <h2>
                    <?php echo $titolo_applicazione; ?>
                </h2>
                <ul class="nav">
                    <?php
                    // Stampa dinamicamente i link del menu
                    foreach ($menuItems as $label => $menu_link) {
                        echo voce_menu($menu_link, $label);
                    }
                    ?>

                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crea Cliente</h2>
                    <p>Per favore compila il modulo ed invialo per aggiungere un cliente al sistema Betty.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <label>Nome</label>
                            <input type="text" name="nome"
                                class="form-control <?php echo (!empty($nome_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $nome; ?>">
                            <span class="invalid-feedback">
                                <?php echo $nome_err; ?>
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
                        <input type="submit" class="btn btn-primary" value="Invia">
                        <a href="../dashboard.php" class="btn btn-secondary ml-2">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>