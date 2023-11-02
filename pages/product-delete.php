<?php
require_once("../config/database.php");

$id = $_GET["id"];

$statement = $conn->prepare("delete from products where id = ?");
$statement->bind_param("i", $id);
if ($statement->execute()) {
    echo
    "
            <script type='text/javascript'>
                alert('Data berhasil dihapus');
                window.location='/pages/product.php';
            </script>
        ";
}
$statement->close();
