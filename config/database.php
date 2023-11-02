<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "sri_anugrah";

$conn = new mysqli($host, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->error);
}

return $conn;
