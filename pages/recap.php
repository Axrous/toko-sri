<?php
require_once(__DIR__ . "/../config/database.php");
require("../config/fpdf.php");

$pdf = new FPDF();
$pdf->AddPage();


$firstDate = date("y-m-d", strtotime($_POST["first_date"]));
$lastDate = date("y-m-d", strtotime($_POST["last_date"]));
// $firstDate = $firstDate . " " . "00:00:00";
// $lastDate = $lastDate . " " . "00:00:00";

if ($_POST['type'] != "pengeluaran") {
    $statement = $conn->prepare("SELECT p.name as product_name, i.price_buy, i.price_sell, i.amount, i.date FROM incomes as i left join products as p on p.id = i.product_id where date >= ? and date <= ?");
    $statement->bind_param("ss", $firstDate, $lastDate);
    $statement->execute();
    $results = $statement->get_result();

    if ($results->num_rows > 0) {

        $pdf->SetFont('Arial', 'B', 12);

        // Header kolom
        $header = array('NO', 'Product', 'Harga Beli', 'Harga Jual', 'Jumlah', 'Tanggal');
        foreach ($header as $col) {
            $pdf->Cell(30, 12, $col, 1);
        }
        $pdf->Ln();

        // Tampilkan data
        $num = 1;
        while ($row = $results->fetch_assoc()) {
            $data = array(
                $num,
                $row['product_name'],
                $row['price_buy'],
                $row['price_sell'],
                $row['amount'],
                date("d-m-y", strtotime($row['date']))
            );
            $pdf->SetFont('Arial', '', 10); // Set font kembali ke normal
            foreach ($data as $value) {
                $pdf->Cell(30, 12, $value, 1);
            }
            $pdf->Ln();
            $num++;
        }
    } else {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 12, 'No data found', 1, 1, 'C');
    }
    $pdf->Output();
} else {
    $statement = $conn->prepare("SELECT description, price, amount, unit, date FROM expenses where date >= ? and date <= ?");
    $statement->bind_param("ss", $firstDate, $lastDate);
    $statement->execute();
    $results = $statement->get_result();

    if ($results->num_rows > 0) {

        $pdf->SetFont('Arial', 'B', 12);

        // Header kolom
        $header = array('No', 'Deskripsi', 'Harga', 'Jumlah', 'Satuan', 'Tanggal');
        foreach ($header as $col) {
            $pdf->Cell(30, 12, $col, 1);
        }
        $pdf->Ln();

        // Tampilkan data
        $num = 1;
        while ($row = $results->fetch_assoc()) {
            $data = array(
                $num,
                $row['description'],
                $row['price'],
                $row['amount'],
                $row['unit'],
                date("d-m-y", strtotime($row['date']))
            );
            $pdf->SetFont('Arial', '', 10); // Set font kembali ke normal
            foreach ($data as $value) {
                $pdf->Cell(30, 12, $value, 1);
            }
            $pdf->Ln();
            $num++;
        }
    } else {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 12, 'No data found', 1, 1, 'C');
    }
    $pdf->Output();
}
