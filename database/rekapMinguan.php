<?php

include "database/koneksi.php";

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
    SELECT * FROM kas
");

while($d = mysqli_fetch_assoc($dataTotal)){

    if($d['jenis'] == "Pemasukan"){
        $totalPemasukan += $d['jumlah'];
    }

    if($d['jenis'] == "Pengeluaran"){
        $totalPengeluaran += $d['jumlah'];
    }
}

$saldoAkhir = $totalPemasukan - $totalPengeluaran;
?>