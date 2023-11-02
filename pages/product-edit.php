<?php
require_once("../config/database.php");

$name = $_POST["name"];
$price_buy = $_POST["price_buy"];
$price_sell = $_POST["price_sell"];
$stock = $_POST["stock"];
$id = $_POST["id"];

$statement = $conn->prepare("UPDATE products SET name = ?, price_buy = ?, price_sell = ?, stock = ? where id = ?");
$statement->bind_param("siiii", $name, $price_buy, $price_sell, $stock, $id);
if ($statement->execute()) {
    echo
    "
            <script type='text/javascript'>
                alert('Data berhasil diupdate');
                window.location='/pages/product.php';
            </script>
        ";
}
$statement->close();
