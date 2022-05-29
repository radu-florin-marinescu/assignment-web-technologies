<?php
include '../../database/connection.php';
require '../../functions/functions.php';

$query = "SELECT * FROM orders";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);


if ($count > 0) {
  $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $index = 1;
  $root = null;
?>
  {
  "orders":
  [
  <?php
  foreach ($orders as $current) {
    $status = $current["status"];
  ?>
    {
    "index":<?= $index ?>,
    "currentId":"<?= $current["id"] ?>",
    "clientEmail":"<?= $current["client"] ?>",
    "totalRon":<?= $current["total"] ?>,
    "date":"<?= $current["date"] ?>",
    "paymentType":"<?= $current["payment"] ?>",
    "current":"<?= $current["workmanship"] ?>",
    "currentPercentage":"<?= $current["workmanship_percentage"] ?>",
    "quantity":<?= $current["quantity"] ?>
    }
    <?= $index < $count ? "," : "" ?>
<?php
    $index = $index + 1;
  }
}
?>
]}