<?php

require_once(__DIR__ . "/../config/database.php");

$limit = $_GET["limit"] ?? 20;
$page = $_GET["page"] ?? 1;


if (isset($_GET["product_name"])) {
    $keyword = $_GET["product_name"];
    $statement = $conn->prepare("SELECT id, name, price_buy, price_sell, stock from products where name like ?");
    $keyword = "%" . $keyword . "%";
    $statement->bind_param("s", $keyword);
    $statement->execute();
    $products = $statement->get_result();

    //total pages;
    $statement = $conn->prepare("select count(id) from products where name like ?");
    $statement->bind_param("s", $keyword);
    $statement->execute();
    $result = $statement->get_result();
    $total_row = $result->fetch_column();
    $total_pages = ceil($total_row / $limit);
} else {
    $offset = ($limit * $page) - $limit;
    $statement = $conn->prepare("SELECT id, name, price_buy, price_sell, stock from products order by name LIMIT ? OFFSET ?");
    $statement->bind_param("ii", $limit, $offset);
    $statement->execute();
    $products = $statement->get_result();

    //total pages;
    $statement = $conn->prepare("select count(id) from products ");
    $statement->execute();
    $result = $statement->get_result();
    $total_row = $result->fetch_column();
    $total_pages = ceil($total_row / $limit);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/header.php") ?>

<body>
    <?php include("../includes/side_bar.php") ?>

    <div class="p-4 sm:ml-64">
        <div class="flex justify-between w-10/12 mx-auto align-middle">
            <a href="./product-tambah.php" class="bg-blue-600 py-2 px-3 text-white rounded-md mt-4 inline-block">Add New</a>
            <form action="product.php" class="mt-4" method="get">
                <div class="flex">
                    <input type="text" name="product_name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" class="ml-2 px-8 py-2 bg-blue-600 text-white rounded-md">Cari</button>
                </div>
            </form>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Beli
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Jual
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stok
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()) { ?>
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?= $product["name"] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= number_format($product["price_buy"], 0, ',', '.'); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= number_format($product["price_sell"], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= number_format($product["stock"], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="./product-form-edit.php?id=<?= $product["id"] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a> | <a href="./product-delete.php?id=<?= $product["id"] ?>" class="font-medium text-red-600  hover:underline" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="mx-auto mt-10 text-center">
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 ">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li>
                        <a href="./product.php?page=<?= $i ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 "><?= $i ?></a>
                    </li>
                <?php } ?>
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 ">Next</a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>