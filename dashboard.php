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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="nofollow" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="frontend/main.js"></script>
  <title>TableView</title>


</head>

<body class="background-grey">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" style='margin-left: 50px' href="#">Proiect</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="col">
          <div class="title" style="margin-top: 40px; margin-bottom: 15px">Grafic Vanzări:</div>
          <div id="chart-root">
            <canvas id="chart" width="400" height="400"></canvas>
          </div>
        </div>

        <div class="col">
          <div>
            <div class="title" style="margin-top: 40px; margin-bottom: 15px">Profitability calculator: </div>
            <div class="form-group">
              <label class="control-label mb-1 form-label">Total</label>
              <input name="client" id="total" type="text" class="form-control" value="150">
            </div>
            <div class="form-group has-success">
              <label class="control-label mb-1 form-label">Taxes (percentage 0-100)</label>
              <input name="total" id="taxes" type="text" class="form-control" value="25">
            </div>
            <div class="form-group has-success">
              <label class="control-label mb-1 form-label">Transport cost</label>
              <input name="quantity" id="transport" type="text" class="form-control" value="20">
            </div>
            <div class="row form-group d-flex justify-content-center align-items-center">
              <div class="col">
                <div class="d-flex justify-content-center">
                  <button class="btn btn-lg background-marine color-white" id="calculateButton" value="calculateButton" onclick="calculatePrice()">
                    <span>Calculate NET profit</span>
                  </button>
                </div>
              </div>

              <div class="col" style="margin-top: 50px;">
                <h3 class="text-center title" id="price-output">0.0 RON</h3>
              </div>
            </div>
          </div>
        </div>
        <?php

        $query = "SELECT * FROM orders";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        //                    header('Content-Type: text/plain');
        if ($count > 0) {
          $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $xml = new SimpleXMLElement('<root/>');
          foreach ($orders as $current) {
            $or = $xml->addChild('order', '');
            array_walk_recursive(
              $current,
              function ($value, $key) use ($or) {
                $or->addChild($key, $value);
              }
            );
          }
          //                        echo $xml->asXML();
        }
        ?>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  function calculatePrice() {
    // document.getElementById('price-output').value = "fasfasfasf";
    // alert(document.getElementById("price-output").textContent);
    var total, transport, taxes, sum;
    total = parseInt(document.getElementById("total").value);
    transport = parseInt(document.getElementById("transport").value);
    taxes = parseInt(document.getElementById("taxes").value);
    sum = total - (taxes / 100 * total) - transport;
    // alert(sum)
    document.getElementById("price-output").textContent = sum.toString() + " RON";
  }
</script>

</html>