<?php
require_once(__DIR__ . "/../config/database.php");

$date = $_POST["date"];
$desc = $_POST["desc"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$unit = $_POST["unit"];

$newDate = date("Y-m-d", strtotime($date));

$statement = $conn->prepare("INSERT INTO expenses(date, description, price, amount, unit) VALUES(?, ?, ?, ?, ?)");
$statement->bind_param("ssiis", $newDate, $desc, $price, $amount, $unit);
if ($statement->execute()) {
    echo
    "
            <script type='text/javascript'>
                alert('Data telah disimpan');
                window.location='/toko-sri/pages/expenses.php';
            </script>
        ";
}
$statement->close();
