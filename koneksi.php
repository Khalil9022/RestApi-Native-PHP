<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "testapisource";

$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("koneksi tidak tersambung " . mysqli_connect_error());
}
