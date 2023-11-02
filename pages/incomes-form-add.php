<!DOCTYPE html>
<html lang="en">
<?php require_once(__DIR__ . "/../config/database.php"); ?>

<body class="max-w-screen-lg mx-auto">
    <?php include("../includes/side_bar.php") ?>
    <div class="p-4 sm:ml-64">
        <h1 class="mt-10 mx-auto text-2xl">TAMBAH PEMASUKAN</h1>
        <form class="mt-8" method="post" action="./incomes-save.php" enctype="multipart/form-data">
            <div class="w-full flex justify-between">
                <div class="w-3/12 mb-6">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-900">Id Product</label>
                    <input type="text" class="search-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" list="results" autocomplete="off" name="product" id="product">
                    <datalist id="results">
                    </datalist>
                </div>
                <div class="w-3/12 mb-6">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                    <input type="text" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div class="w-3/12 mb-6 my-auto">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Harga Jual</label>
                    <input type="text" id="amount" name="price_sell" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
            </div>
            <input type="submit" value="Submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
        </form>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('input', '.search-input', function() {
            var query = $(this).val();
            var results = $(this).siblings('datalist');

            if (query == "") {
                results.empty();
            } else {
                $.ajax({
                    url: 'product-get.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        results.html(data);
                    }
                });
            }
        });
    });

    // document.getElementById('add-item').addEventListener('click', function() {
    //     const productInput = document.getElementById('product');
    //     const totalInput = document.getElementById('amount');

    //     const product = productInput.value;
    //     const total = totalInput.value;

    //     const itemHtml = `<li>${product} - ${total}</li>`;
    //     document.getElementById('item-list').innerHTML += itemHtml;

    //     // Kosongkan nilai input setelah menambahkan item
    //     productInput.value = '';
    //     totalInput.value = '';
    // });
</script>

</html>