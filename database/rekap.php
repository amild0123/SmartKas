<?php
include "koneksi.php";

$tarif = 5000;
$data = [];

$totalSiswa = $conn->query("SELECT COUNT(*) as total FROM kas")->fetch_assoc()['total'];
$totalKas = 0;

for ($i = 1; $i <= 4; $i++) {
    $sudahBayar = $conn->query("SELECT COUNT(*) as total FROM kas WHERE minggu$i = 1")->fetch_assoc()['total'];
    $keseluruhan = $totalSiswa * $tarif;
    $pemasukan   = $sudahBayar * $tarif;
    $nunggak     = $keseluruhan - $pemasukan;

    $data["minggu$i"] = [
        "keseluruhan" => $keseluruhan,
        "pemasukan"   => $pemasukan,
        "nunggak"     => $nunggak
    ];

    $totalKas += $pemasukan; // akumulasi pemasukan
}

$data["totalKas"] = $totalKas;

header('Content-Type: application/json');
echo json_encode($data);
?>
