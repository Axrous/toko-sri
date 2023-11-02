<?php

require_once(__DIR__ . "/../config/database.php");
$id = $_GET["id"];

$statement = $conn->prepare("select id, description, price, amount, unit from expenses where id = ?");
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
$expenses = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/header.php") ?>

<body class="max-w-screen-lg mx-auto">
    <?php include("../includes/side_bar.php") ?>
    <div class="p-4 sm:ml-64">
        <h1 class="mt-10 mx-auto text-2xl">UPDATE PENGELUARAN</h1>
        <form class="mt-8" action="./expenses-update.php" method="post">
            <input type="hidden" value="<?= $expenses["id"] ?>" name="id">
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <input type="text" id="product" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $expenses["description"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                <input type="text" id="product" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $expenses["price"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                <input type="text" id="product" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $expenses["amount"] ?>">
            </div>
            <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900">Satuan</label>
                <input type="text" id="product" name="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="<?= $expenses["unit"] ?>">
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>
</body>

</html>