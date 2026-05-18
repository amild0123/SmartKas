<?php
include "koneksi.php";

$data = [];

// Hitung jumlah siswa yang sudah bayar tiap minggu
for ($i = 1; $i <= 4; $i++) {
    $sql = "SELECT COUNT(*) as total FROM kas WHERE minggu$i = 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data["minggu$i"] = $row['total'];
}

echo json_encode($data);
?>
