<?php
include 'koneksi.php';

$nama  = $_POST['nama'];
$absen = $_POST['absen'];

// ubah nilai checkbox jadi angka (1 kalau dicentang, 0 kalau tidak)
$minggu1 = isset($_POST['minggu1']) ? 1 : 0;
$minggu2 = isset($_POST['minggu2']) ? 1 : 0;
$minggu3 = isset($_POST['minggu3']) ? 1 : 0;
$minggu4 = isset($_POST['minggu4']) ? 1 : 0;

$query = mysqli_query($conn, "
    INSERT INTO kas (nama, absen, minggu1, minggu2, minggu3, minggu4)
    VALUES ('$nama', '$absen', '$minggu1', '$minggu2', '$minggu3', '$minggu4')
");

if ($query) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
