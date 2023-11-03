<?php

require_once(__DIR__ . "/../config/database.php");

$limit = $_GET["limit"] ?? 20;
$page = $_GET["page"] ?? 1;

$offset = ($limit * $page) - $limit;
$statement = $conn->prepare("SELECT i.id as id, p.name as product_name, i.price_buy as price_buy, i.price_sell, amount, date from incomes as i left join products as p on p.id = i.product_id order by date desc LIMIT ? OFFSET ?");
$statement->bind_param("ii", $limit, $offset);
$statement->execute();
$results = $statement->get_result();

//total pages;
$statement = $conn->prepare("select count(id) from incomes ");
$statement->execute();
$result = $statement->get_result();
$total_row = $result->fetch_column();
$total_pages = ceil($total_row / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/header.php") ?>

<body>
    <?php include("../includes/side_bar.php") ?>
    <div class="p-4 sm:ml-64">
        <a href="/toko-sri/pages/incomes-form-add.php" class="bg-blue-600 text-white px-4 py-3 rounded-lg mt-10 inline-block">Add Pemasukan</a>
        <table class="w-full text-sm text-left text-gray-500 mt-10">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
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
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Satuan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php while ($result = $results->fetch_assoc()) { ?>
                    <tr class="bg-white border-b  hover:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <?= date("d-m-y", strtotime($result["date"])) ?>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <?= $result["product_name"] ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= number_format($result["price_buy"], 0, ',', '.'); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= number_format($result["price_sell"], 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= number_format($result["amount"], 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-4">
                            PCS
                        </td>
                        <td class="px-6 py-4">
                            <?= $result["price_sell"] * $result["amount"] ?>
                        </td>
                        <!-- <td class="px-6 py-4">
                            <a href="./product-form-edit.php?id=<?= $product["id"] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a> | <a href="./product-delete.php?id=<?= $product["id"] ?>" class="font-medium text-red-600  hover:underline" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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