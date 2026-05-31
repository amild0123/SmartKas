<?php

include "koneksi.php";

/*
========================================
TAMBAH DATA
========================================
*/

if(isset($_POST['tambahKas'])){

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];

    $query = mysqli_query($conn, "
        INSERT INTO kas
        VALUES(
            '',
            '$tanggal',
            '$keterangan',
            '$jenis',
            '$jumlah'
        )
    ");

    if($query){

        header("Location: recap.php");
        exit;

    } else {

        echo "
        <script>
            alert('Data gagal ditambahkan');
        </script>
        ";

    }

}

?>