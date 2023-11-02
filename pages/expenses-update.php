<?php
require_once(__DIR__ . "/../config/database.php");

$id = $_POST["id"];
$desc = $_POST["desc"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$unit = $_POST["unit"];

$statement = $conn->prepare("UPDATE expenses SET description = ?, price = ?, amount = ?, unit = ? where id = ?");
$statement->bind_param("siisi", $desc, $price, $amount, $unit, $id);
if ($statement->execute()) {
    echo
    "
            <script type='text/javascript'>
                alert('Data berhasil diupdate');
                window.location='/toko-sri/pages/expenses.php';
            </script>
        ";
}
$statement->close();
