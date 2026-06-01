<?php

include "koneksi.php";

if(isset($_POST['tanggal'], $_POST['keterangan'], $_POST['jenis'], $_POST['jumlah'])){

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];
    $jumlah = intval($_POST['jumlah']);

    // validasi input
    if($tanggal === '' || $keterangan === '' || $jenis === '' || $jumlah <= 0){
        echo "Semua field harus diisi dan nominal harus lebih dari 0";
        exit;
    }

    // insert ke tabel rekap
    $query = mysqli_query($conn, "
        INSERT INTO rekap (tanggal, keterangan, jenis, jumlah)
        VALUES ('$tanggal', '$keterangan', '$jenis', $jumlah)
    ");

    if($query){
        echo "success";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }

} else {
    echo "Data tidak lengkap";
}

?>
