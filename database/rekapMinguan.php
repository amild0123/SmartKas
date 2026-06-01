<?php

include __DIR__ . "/koneksi.php";

/*
========================================
AMBIL DATA
========================================
*/

$dataKas = mysqli_query($conn, "
    SELECT * FROM rekap
    ORDER BY tanggal ASC
");

/*
========================================
TOTAL
========================================
*/

$totalPemasukan = 0;
$totalPengeluaran = 0;

$dataTotal = mysqli_query($conn, "
    SELECT * FROM rekap
");

while($d = mysqli_fetch_assoc($dataTotal)){
    $jenis = isset($d['jenis']) ? strtolower(trim($d['jenis'])) : '';

    if($jenis === "pemasukan" || $jenis === "masuk"){
        $totalPemasukan += $d['jumlah'];
    }

    if($jenis === "pengeluaran" || $jenis === "keluar"){
        $totalPengeluaran += $d['jumlah'];
    }
}

$saldoAkhir = $totalPemasukan - $totalPengeluaran;
?>