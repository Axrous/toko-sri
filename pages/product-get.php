<?php
require_once(__DIR__ . "/../config/database.php");

if (isset($_POST["query"])) {
    $keyword = $_POST["query"];
    $statement = $conn->prepare('SELECT id, name, price_buy, price_sell, stock from products where name like ?');
    $keyword = '%' . $keyword . '%';
    $statement->bind_param("s", $keyword);
    $statement->execute();
    $products = $statement->get_result();

    if ($products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    } else {
        echo "No results found.";
    }
}
