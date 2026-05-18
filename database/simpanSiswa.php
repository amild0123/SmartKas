<?php

include 'koneksi.php';

$nama = $_POST['nama'];
$absen = $_POST['absen'];

$query = mysqli_query($conn, "
INSERT INTO kas
(nama, absen, minggu1, minggu2, minggu3, minggu4)

VALUES
('$nama', '$absen',
'" . (isset($_POST['minggu1']) ? 1 : 0) . "',
'" . (isset($_POST['minggu2']) ? 1 : 0) . "',
'" . (isset($_POST['minggu3']) ? 1 : 0) . "',
'" . (isset($_POST['minggu4']) ? 1 : 0) . "'
)");

if($query){

    echo "success";

}else{

    echo mysqli_error($conn);

}

?>