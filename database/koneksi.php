<?php
$conn = mysqli_connect("localhost", "root", "", "smartkas");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>