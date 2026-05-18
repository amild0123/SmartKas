<?php

include 'koneksi.php';

$nama = $_POST['nama'];
$absen = $_POST['absen'];

$query = mysqli_query($conn, "
    INSERT INTO kas
    (nama, absen, minggu1, minggu2, minggu3, minggu4)

    VALUES
    ('$nama', '$absen', 'Belum', 'Belum', 'Belum', 'Belum')
");

if($query){

    echo "success";

}else{

    echo mysqli_error($conn);

}

?>