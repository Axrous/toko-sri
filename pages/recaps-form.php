<?php

require_once("../config/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../includes/header.php") ?>

<body>
    <?php include("../includes/side_bar.php") ?>
    <div class="p-4 sm:ml-64">
        <div class="w-10/12 mx-auto m-6">
            <h1 class="text-2xl uppercase">Rekap Pemasukan</h1>
            <form action="recap.php" class="flex mt-4 items-center" method="post">
                <div class="">
                    <label for="from">Dari Tanggal: </label>
                    <input type="date" name="first_date" class=" rounded-lg p-2 border-2 hover:cursor-pointer">
                    <label for="until" class="ml-3">Sampai Tanggal: </label>
                    <input type="date" name="last_date" class=" rounded-lg p-2 border-2">
                </div>
                <div class="ml-10">
                    <button type="submit" class="border my-auto block px-4 py-2 bg-blue-500 text-white rounded-xl">Cetak</button>
                </div>
            </form>
        </div>
        <div>
            <h1>Rekap Pengeluaran</h1>
        </div>
    </div>
</body>

</html>