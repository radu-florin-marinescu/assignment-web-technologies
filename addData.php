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
<div class="page-container background-grey">
    <div class="container-fluid">
        <div class="card form-margins">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title">Add new order</h3>
                </div>
                <hr>
                <form method="post" novalidate="novalidate">
                    <div class="form-group">
                        <label class="control-label mb-1 form-label">Client</label>
                        <input name="client" type="text" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <label class="control-label mb-1 form-label">Total</label>
                        <input name="total" type="text" class="form-control">
                    </div>
                    <div class="form-group has-success">
                        <label class="control-label mb-1 form-label">Quantity</label>
                        <input name="quantity" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-1 form-label">Return reason</label>
                        <input id="return_reason" name="return_reason" type="tel" class="form-control">
                    </div>
                    <i class='fas fa-angle-down' style='font-size:24px'></i>
                    <div>
                        <label class="control-label mb-1 form-label">Payment method</label>
                        <select name="payment" id="select" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                    <div class="checkbox" style="margin-top: 10px">
                        <label for="control-label mb-1 form-label">
                            <input type="checkbox" id="workmanship" name="workmanship" value="workmanship"
                                   class="form-check-input form-label option-margins">Workmanship
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-1 form-label">Workmanship percentage</label>
                        <input id="workmanship_percentage" name="workmanship_percentage" type="tel"
                               class="form-control">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="save" type="save" name="save" class="btn btn-lg background-marine color-white">
                            <span>Add new order</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once("database/connection.php");

function guidv4($data = null)
{
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

if (isset($_POST['save'])) {
    $client = $_POST['client'];
    $total = $_POST['total'];
    $myuuid = guidv4();
    $date = date("Y-d-d h:i:s");
    $payment = $_POST['payment'];
    $workmanship = $_POST['workmanship'];
    $workmanship_percentage = $_POST['workmanship_percentage'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $return_reason = $_POST['return_reason'];
    echo $date;

    $sql = 'INSERT INTO orders ($myuuid,client,total,payment,workmanship,workmanship_percentage,quantity,return_reason) VALUES ("' . $myuuid . '","' . $client . '", "' . $total . '","' . $payment . '","' . $workmanship . '","' . $workmanship_percentage . '","' . $quantity . '","' . $return_reason . '")';
    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully !";
        header("Location:index.php");

    } else {
        echo "Error: " . $sql . " " . mysqli_error($connection);
    }
}
?>