<?php

require_once(__DIR__ . "/../config/database.php");

$limit = $_GET["limit"] ?? 10;
$page = $_GET["page"] ?? 1;

$offset = ($limit * $page) - $limit;
$statement = $conn->prepare("SELECT id, date, description, price, amount, unit from expenses order by id desc limit ? offset ?");
$statement->bind_param("ii", $limit, $offset);
$statement->execute();
$expenses = $statement->get_result();

//total pages;
$statement = $conn->prepare("select count(id) from expenses");
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
        <h1>PENGELUARAN</h1>
        <a href="./expenses-form-add.php" class="bg-blue-600 py-2 px-3 text-white rounded-md mt-4 inline-block">Add New</a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
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
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($expense = $expenses->fetch_assoc()) { ?>
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <?= date("d-m-y", strtotime($expense["date"])) ?>
                            </th>
                            <td scope="row" class="px-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                                <?= $expense["description"] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= number_format($expense["price"], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $expense["amount"] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $expense["unit"] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= number_format($expense["price"] * $expense["amount"], 0, ',', '.')  ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="./expenses-form-update.php?id=<?= $expense["id"] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a> | <a href="./expenses-delete.php?id=<?= $expense["id"] ?>" class="font-medium text-red-600  hover:underline" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>