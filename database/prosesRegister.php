<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil, silakan login!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
