<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Betty Search</title>
    <style>
        body {
            font-family: Arail, sans-serif;
        }

        /* Formatting search box */
        .search-box {
            width: 300px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }

        .search-box input[type="text"] {
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }

        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .search-box input[type="text"],
        .result {
            width: 100%;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }

        .result p:hover {
            background: #f2f2f2;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.search-box input[type="text"]').on("keyup input", function () {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", { term: inputVal }).done(function (data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function () {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>

<body>
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
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Cerca cliente..." />
        <div class="result"></div>
    </div>
</body>

</html>