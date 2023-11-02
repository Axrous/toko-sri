<?php
require_once(__DIR__ . "/../config/database.php");

$name = $_POST["name"];
$price_buy = $_POST["price_buy"];
$price_sell = $_POST["price_sell"];
$stock = $_POST["stock"];

$statement = $conn->prepare("INSERT INTO products(name, price_buy, price_sell, stock) VALUES(?, ?, ?, ?)");
$statement->bind_param("siii", $name, $price_buy, $price_sell, $stock);
if ($statement->execute()) {
    echo
    "
            <script type='text/javascript'>
                alert('Data telah disimpan');
                window.location='/toko-sri/pages/product.php';
            </script>
        ";
}
$statement->close();
