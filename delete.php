<?php
include_once("database/connection.php");

$id = $_GET['id'];
var_dump($id);
echo $id;

$sql = "DELETE FROM `orders` WHERE `orders`.`id` = '$id'";
$result = mysqli_query($connection, $sql);

if ($result === TRUE) {
    header("Location:index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();


