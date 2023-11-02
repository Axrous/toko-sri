<?php

require_once(__DIR__ . "/../config/database.php");
$id = $_GET["id"];

$statement = $conn->prepare("select id, name, price_buy, price_sell, stock from products where id = ?");
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/header.php") ?>

<body class="max-w-screen-lg mx-auto">
    <?php include("../includes/side_bar.php") ?>
    <div class="p-4 sm:ml-64">
        <h1 class="mt-10 mx-auto text-2xl">update PRODUK</h1>
        <form class="mt-8" method="post" action="./product-edit.php">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Nama Product</label>
                <input type="text" id="product" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $product["name"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Harga Beli</label>
                <input type="text" id="product" name="price_buy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $product["price_buy"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Harga Jual</label>
                <input type="text" id="product" name="price_sell" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $product["price_sell"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                <input type="text" id="product" name="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $product["stock"] ?>">
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>
</body>

</html>