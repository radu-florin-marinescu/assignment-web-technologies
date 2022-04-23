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

<body>
<div class="page-container background-grey">
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
                        <th>Actiuni</th>
                    </tr>
                    </thead>
                    <tbody class="background-white color-dark">
                    <tr>
                        <td>1</td>
                        <td>322579e0-c248-11ec-9d64-0242ac120002</td>
                        <td>marian.ceargau@yahoo.com</td>
                        <td>2,489.99 RON</td>
                        <td>14.04.2022 - 14:55</td>
                        <td>CARD</td>
                        <td>DA</td>
                        <td>15.0%</td>
                        <td>104.99 RON</td>
                        <td>12</td>
                        <td>TRIMIS</td>
                        <td>---</td>
                    </tr>
                    <tr class="background-light-grey">
                        <td>2</td>
                        <td>322579e0-c248-11ec-9d64-0242ac120002</td>
                        <td>radu.marinescu.florin.testmail@mail.com</td>
                        <td>14.99 RON</td>
                        <td>17.04.2022 - 18:30</td>
                        <td>CASH</td>
                        <td>NU</td>
                        <td>-</td>
                        <td>-</td>
                        <td>2</td>
                        <td>PRIMIT</td>
                        <td class="last">---</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

</html>