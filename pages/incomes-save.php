<?php

require_once(__DIR__ . "/../config/database.php");

$productId = $_POST["product"];
$amountProduct = $_POST["amount"];
$priceSell = $_POST["price_sell"];

$date = date("y-m-d");

$conn->begin_transaction();
try {
    //get Product
    $statement = $conn->prepare("select id, name, price_buy, stock from products where id = ?");
    $statement->bind_param("i", $productId);
    $statement->execute();
    $result = $statement->get_result();
    $product = $result->fetch_assoc();

    //save to incomes

    if ($product["stock"] < $amountProduct) {
        throw new Exception("Product " . $product["name"] . " kurang");
    }
    $statement = $conn->prepare("insert into incomes(product_id, price_buy, price_sell, amount, date) values(?, ?, ?, ?, ?)");
    $statement->bind_param("iiiis", $productId, $product["price_buy"], $priceSell, $amountProduct, $date);
    $statement->execute();

    //change stock in product;
    $stock = $product["stock"] - $amountProduct;
    $statement->prepare("update products set stock = ? where id = ?");
    $statement->bind_param("ii", $stock, $productId);
    $statement->execute();

    $conn->commit();
    echo "<script type='text/javascript'>
        window.location='/toko-sri/pages/incomes.php';
        </script>";
} catch (\Exception $e) {
    echo $e->getMessage();
    $conn->rollback();
    echo "<script type='text/javascript'>
            alert('" . $e->getMessage() . "');
            window.location='/toko-sri/pages/incomes-form-add.php';
        </script>";
}
