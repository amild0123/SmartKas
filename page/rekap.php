<?php
include "database/rekapMinguan.php";
?>

<div class="rekap-wrapper">
    <!-- TITLE --> 
    <div class="rekap-title">
        <h1 id="judulBulanRekap" ></h1>
    </div>

    <!-- CARD -->
    <div class="rekap-card-container">

        <div class="rekap-card">
            <h3>Total Pemasukan</h3>
            <h2 class="rekap-green">
                Rp <?= number_format($totalPemasukan,0,',','.') ?>
            </h2>
        </div>

        <div class="rekap-card">
            <h3>Total Pengeluaran</h3>
            <h2 class="rekap-red">
                Rp <?= number_format($totalPengeluaran,0,',','.') ?>
            </h2>
        </div>

        <div class="rekap-card">
            <h3>Saldo Akhir</h3>
            <h2 class="rekap-blue">
                Rp <?= number_format($saldoAkhir,0,',','.') ?>
            </h2>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="rekap-content">

        <div class="rekap-box">

            <div class="rekap-box-header">
                <h2>Rekap Mingguan Bulan Januari</h2>
            </div>

            <table class="rekap-table">

                <thead>

                    <tr>
                        <th>Minggu</th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo Akhir</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $mingguan = [

                    [
                        "nama" => "Minggu 1",
                        "mulai" => "2026-01-01",
                        "selesai" => "2026-01-07",
                        "tanggal" => "1 - 7 Januari"
                    ],

                    [
                        "nama" => "Minggu 2",
                        "mulai" => "2026-01-08",
                        "selesai" => "2026-01-14",
                        "tanggal" => "8 - 14 Januari"
                    ],

                    [
                        "nama" => "Minggu 3",
                        "mulai" => "2026-01-15",
                        "selesai" => "2026-01-21",
                        "tanggal" => "15 - 21 Januari"
                    ],

                    [
                        "nama" => "Minggu 4",
                        "mulai" => "2026-01-22",
                        "selesai" => "2026-01-31",
                        "tanggal" => "22 - 31 Januari"
                    ]

                ];

                $saldo = 0;
                $tarif = 5000;

                foreach($mingguan as $index => $m){

                    $pemasukan = 0;
                    $pengeluaran = 0;

                    $weekNum = $index + 1;
                    $resKas = mysqli_query($conn, "SELECT COUNT(*) as total FROM kas WHERE minggu$weekNum = 1");
                    $paidCount = 0;
                    if($resKas){
                        $paidCount = intval(mysqli_fetch_assoc($resKas)['total']);
                    }
                    $pemasukan += $paidCount * $tarif;

                    $query = mysqli_query($conn, "SELECT jenis, jumlah FROM rekap WHERE tanggal BETWEEN '{$m['mulai']}' AND '{$m['selesai']}'");

                    if($query){
                        while($data = mysqli_fetch_assoc($query)){
                            $jenis = isset($data['jenis']) ? strtolower(trim($data['jenis'])) : '';
                            if($jenis === "Pemasukan" || $jenis === "masuk"){
                                $pemasukan += $data['jumlah'];
                            }
                            if($jenis === "Pengeluaran" || $jenis === "keluar"){
                                $pengeluaran += $data['jumlah'];
                            }
                        }
                    }

                    $saldo += $pemasukan - $pengeluaran;

                ?>

                    <tr>
                        <td><?= $m['nama'] ?></td>
                        <td><?= $m['tanggal'] ?></td>
                        <td class="rekap-green">
                            Rp <?= number_format($pemasukan,0,',','.') ?>
                        </td>
                        <td class="rekap-red">
                            Rp <?= number_format($pengeluaran,0,',','.') ?>
                        </td>
                        <td class="rekap-blue">
                            Rp <?= number_format($saldo,0,',','.') ?>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>





        <!-- =========================
        GROUP 59 / DETAIL PEMASUKAN
        ========================= -->

        <div class="group59-box">

            <div class="group59-header">
                <h2>Detail Transaksi Bulan Januari</h2>
            </div>

            <table class="group59-table">

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Jumlah (Rp)</th>
                    </tr>

                </thead>

                <tbody>

                    <?php
                    $totalDetail = 0;
                    $queryTransaksi = mysqli_query($conn, "SELECT * FROM rekap ORDER BY tanggal ASC");
                    while($row = mysqli_fetch_assoc($queryTransaksi)){
                        $totalDetail += $row['jumlah'];
                        $jenisRow = isset($row['jenis']) ? strtolower(trim($row['jenis'])) : '';
                        $rowClass = ($jenisRow === 'Pemasukan' || $jenisRow === 'masuk') ? 'rekap-green' : 'rekap-red';
                    ?>

                    <tr>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= isset($row['keterangan']) ? $row['keterangan'] : '-' ?></td>
                        <td><?= isset($row['jenis']) ? $row['jenis'] : '-' ?></td>
                        <td class="<?= $rowClass ?>">Rp <?= number_format($row['jumlah'],0,',','.') ?></td>
                    </tr>

                    <?php } ?>

                </tbody>

                <tfoot>

                    <tr>

                        <td colspan="3" class="total-text">
                            Total Transaksi
                        </td>

                        <td class="total-harga">
                            Rp <?= number_format($totalDetail,0,',','.') ?>
                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

        <script src="js/rekap.js"></script> <!-- Script utama -->

</body>
</html>