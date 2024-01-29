<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Betty Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Clienti</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Aggiungi
                            nuovo cliente</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Tentativo di esecuzione select query 
                    $sql = "SELECT * FROM clienti";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Cognome</th>";
                            echo "<th>Nome</th>";
                            echo "<th>Telefono</th>";
                            echo "<th>Azione</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['cognome'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['telefono'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="Vedi Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Aggiorna Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Elimina Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>Nessun record trovato.</em></div>';
                        }
                    } else {
                        echo "Oops! Qualcosa andato storto. Riprova piu tardi.";
                    }

                    // Chiudi connessione
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>