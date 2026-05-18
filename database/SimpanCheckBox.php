<?php
include "koneksi.php";

// Ambil data JSON dari fetch()
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo "Tidak ada data diterima";
    exit;
}

// Loop setiap item checkbox
foreach ($data as $item) {
    $id = $item['id'];
    $minggu = $item['minggu'];
    $status = $item['status'];

    // Update status di database
    $sql = "UPDATE kas SET $minggu = $status WHERE id = $id";
    $conn->query($sql);
}

echo "Data checkbox berhasil disimpan!";
$conn->close();
?>
