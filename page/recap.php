<?php
session_start();

/*
========================================
MEMBUAT ARRAY KOSONG
========================================
*/

if(!isset($_SESSION['dataKas'])){
    $_SESSION['dataKas'] = [];
}

/*
========================================
MENAMBAHKAN DATA DARI FORM
========================================
*/

if(isset($_POST['submit'])){

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];

    $dataBaru = [
        "tanggal" => $tanggal,
        "keterangan" => $keterangan,
        "jenis" => $jenis,
        "jumlah" => $jumlah
    ];

    $_SESSION['dataKas'][] = $dataBaru;
}

/*
========================================
MENGAMBIL DATA
========================================
*/

$dataKas = $_SESSION['dataKas'];

/*
========================================
MENGHITUNG TOTAL
========================================
*/

$totalPemasukan = 0;
$totalPengeluaran = 0;

foreach($dataKas as $data){

    if($data['jenis'] == "Pemasukan"){
        $totalPemasukan += $data['jumlah'];
    }

    if($data['jenis'] == "Pengeluaran"){
        $totalPengeluaran += $data['jumlah'];
    }
}

$saldoAkhir = $totalPemasukan - $totalPengeluaran;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SmartKas</title>

    <link rel="stylesheet" href="css/recap.css">
</head>
<body>

    <!-- TITLE -->
    <div class="title">
        <h1>REKAP KAS BULAN JANUARI</h1>
    </div>

    <!-- CARD -->
    <div class="card-container">

        <div class="card-recap">
            <h3>Total Pemasukan</h3>

            <h2 class="green">
                Rp <?= number_format($totalPemasukan,0,',','.') ?>
            </h2>
        </div>

        <div class="card-recap">
            <h3>Total Pengeluaran</h3>

            <h2 class="red">
                Rp <?= number_format($totalPengeluaran,0,',','.') ?>
            </h2>
        </div>

        <div class="card-recap">
            <h3>Saldo Akhir</h3>

            <h2 class="blue">
                Rp <?= number_format($saldoAkhir,0,',','.') ?>
            </h2>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- RECAP -->
        <div class="table-box">

            <h2>Recap Mingguan Bulan Januari</h2>

            <table>

                <tr>
                    <th>Tanggal</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Saldo</th>
                </tr>

                <?php

                $saldo = 0;

                foreach($dataKas as $kas){

                    $pemasukan = "-";
                    $pengeluaran = "-";

                    if($kas['jenis'] == "Pemasukan"){
                        $pemasukan = "Rp " . number_format($kas['jumlah'],0,',','.');
                        $saldo += $kas['jumlah'];
                    }

                    if($kas['jenis'] == "Pengeluaran"){
                        $pengeluaran = "Rp " . number_format($kas['jumlah'],0,',','.');
                        $saldo -= $kas['jumlah'];
                    }

                ?>

                <tr>

                    <td><?= $kas['tanggal'] ?></td>

                    <td><?= $pemasukan ?></td>

                    <td><?= $pengeluaran ?></td>

                    <td>
                        Rp <?= number_format($saldo,0,',','.') ?>
                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

        <!-- DETAIL -->
        <div class="table-box">

            <h2>Detail Kas Bulan Januari</h2>

            <table>

                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                </tr>

                <?php foreach($dataKas as $kas){ ?>

                <tr>

                    <td><?= $kas['tanggal'] ?></td>

                    <td><?= $kas['keterangan'] ?></td>

                    <td><?= $kas['jenis'] ?></td>

                    <td>
                        Rp <?= number_format($kas['jumlah'],0,',','.') ?>
                    </td>

                </tr>

                <?php } ?>

            </table>

            <!-- FORM -->
            <div class="form-input">

                <h3>Input Kas</h3>

                <form method="POST">

                    <input type="date" name="tanggal" required>

                    <input
                        type="text"
                        name="keterangan"
                        placeholder="Keterangan"
                        required
                    >

                    <select name="jenis">

                        <option>Pemasukan</option>
                        <option>Pengeluaran</option>

                    </select>

                    <input
                        type="number"
                        name="jumlah"
                        placeholder="Jumlah"
                        required
                    >

                    <button type="submit" name="submit">
                        Tambah Data
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>