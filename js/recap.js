const namaBulan = [
  "JANUARI",
  "FEBRUARI",
  "MARET",
  "APRIL",
  "MEI",
  "JUNI",
  "JULI",
  "AGUSTUS",
  "SEPTEMBER",
  "OKTOBER",
  "NOVEMBER",
  "DESEMBER"
];

const sekarang = new Date();
const bulanSekarang = namaBulan[sekarang.getMonth()];

document.getElementById("judulBulan").innerText =
  "INPUT KAS BULAN " + bulanSekarang;

/*
========================================
MENGAMBIL FORM
========================================
*/

const form = document.querySelector("form");

/*
========================================
EVENT SAAT FORM DISUBMIT
========================================
*/

form.addEventListener("submit", function(){

    /*
    ========================================
    MENGAMBIL NILAI INPUT
    ========================================
    */

    const tanggal = document.querySelector('input[name="tanggal"]').value;

    const keterangan = document.querySelector('input[name="keterangan"]').value;

    const jenis = document.querySelector('select[name="jenis"]').value;

    const jumlah = document.querySelector('input[name="jumlah"]').value;

    /*
    ========================================
    VALIDASI INPUT
    ========================================
    */

    if(
        tanggal == "" ||
        keterangan == "" ||
        jumlah == ""
    ){

        alert("Semua data harus diisi!");

        return;
    }

    /*
    ========================================
    ALERT BERHASIL
    ========================================
    */

    alert(
        "Data kas berhasil ditambahkan!\n\n" +

        "Tanggal : " + tanggal +
        "\nKeterangan : " + keterangan +
        "\nJenis : " + jenis +
        "\nJumlah : Rp " + jumlah
    );

});