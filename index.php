<?php
include 'database/connection.php';
require 'functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/main.css" rel="stylesheet">
    <link href="styles/fonts.css" rel="stylesheet">
    <link href="styles/colors.css" rel="stylesheet">
    <link href="styles/tables.css" rel="stylesheet">
    <link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="libraries/font-awesome/css/font-awesome.min.css">
    <script src="libraries/jquery-3.6.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="nofollow"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>TableView</title>
</head>

<body class="background-grey">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" style='margin-left: 50px' href="#">Proiect</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addData.php">Add New</a>
            </li>
        </ul>
    </div>
</nav>
<div class="page-container">
    <div class="container-fluid">
        <div class="row m-t-30">
            <div class="table-responsive">
                <table class="table table-borderless table-style">
                    <thead class="background-dark color-white">
                    <tr>
                        <th>Nr.</th>
                        <th>ID Comanda</th>
                        <th>Client</th>
                        <th>Suma</th>
                        <th>Data</th>
                        <th>Plata</th>
                        <th>Manopera</th>
                        <th>% Manopera</th>
                        <th>Cost manopera</th>
                        <th>Nr. Produse</th>
                        <th>Status</th>
                        <!--                        <th>Motiv retur-->
                        <th>Actiuni</th>
                    </tr>
                    </thead>
                    <tbody class="background-white color-dark">
                    <?php

                    $query = "SELECT * FROM orders";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);

                    if ($count > 0) {
                        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $index = 1;
                        $root = null;
                        foreach ($orders as $current) {
                            $status = $current["status"];
                            $statusColor = getStatusColorByEnumType($status);
                            $statusText = getStatusNameByEnumType($status);
                            $rowBackground = ($index % 2 == 0) ? "background-light-grey" : "background-white";
                            ?>
                            <tr class="<?= $rowBackground ?>">
                                <td><?= $index ?></td>
                                <td><?= $current["id"] ?></td>
                                <td><?= $current["client"] ?></td>
                                <td><?= $current["total"] ?> RON</td>
                                <td><?= $current["date"] ?></td>
                                <td><?= $current["payment"] ?></td>
                                <td><?= $current["workmanship"] ?></td>
                                <td><?= $current["workmanship_percentage"] ?>%</td>
                                <td>0 RON</td>
                                <td><?= $current["quantity"] ?></td>

                                <td class="<?= $statusColor ?>"><?= $statusText ?></td>
                                <!--                                <td>-->
                                <?//= $current["return_reason"] ?><!--</td>-->
                                <td><?php echo "<a href='./delete.php?id=" . $current['id'] . "'>Delete</a>" ?></td>

                                <td></td>
                            </tr>
                            <?php
                            $index = $index + 1;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>