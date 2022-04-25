<?php

// Setare variabile conexiune. Se va incerca o conexiune la baza de date MySQL "proiect"
$hostname = "localhost";
$username = "root";
$password = "";
$database = "proiect";

// Se executa conexiunea la baza de date si se memoreaza in variabila "connection"
$connection = mysqli_connect($hostname, $username, $password, $database);

// Daca conexiunea nu a fost executata cu succes, se va opri programul si se va printa eroarea.
if (!$connection) {
    die(mysqli_connect_error());
}
