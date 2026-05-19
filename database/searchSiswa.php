<?php
include "koneksi.php";

$keyword = $_GET['keyword']; // ambil keyword dari JS

$sql = "SELECT * FROM kas WHERE nama LIKE '%$keyword%'";
$result = $conn->query($sql);

$no = 1;
while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$no++."</td>
            <td>".$row['nama']."</td>
            <td><input type='checkbox' data-id='".$row['id']."' data-minggu='minggu1' ".($row['minggu1'] ? "checked" : "")."></td>
            <td><input type='checkbox' data-id='".$row['id']."' data-minggu='minggu2' ".($row['minggu2'] ? "checked" : "")."></td>
            <td><input type='checkbox' data-id='".$row['id']."' data-minggu='minggu3' ".($row['minggu3'] ? "checked" : "")."></td>
            <td><input type='checkbox' data-id='".$row['id']."' data-minggu='minggu4' ".($row['minggu4'] ? "checked" : "")."></td>
          </tr>";
}
?>
