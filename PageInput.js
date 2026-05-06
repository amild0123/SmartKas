/* ========================
   JUDUL BULAN OTOMATIS
======================== */

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


/* ========================
   CARI SISWA
======================== */

function cariSiswa() {
    const keyword = document
        .getElementById("searchInput")
        .value
        .toLowerCase();

    const hasil = dataSiswa.filter(siswa =>
        siswa.nama.toLowerCase().includes(keyword)
    );

    if (hasil.length === 0) {
        document.getElementById("pesan").innerText =
            "Nama siswa tidak terdaftar";
        const pesan = document.getElementById("pesan");
        pesan.style.color = "red";
    } else {
        document.getElementById("pesan").innerText = "";
    }

    tampilkanData(hasil);
}

/* ========================
   POPUP
======================== */

function bukaPopup() {
    document.getElementById("popup").style.display = "flex";
}

function tutupPopup() {
    document.getElementById("popup").style.display = "none";
    document.getElementById("inputNama").value = "";
}


/* ========================
   DATA SISWA
======================== */
let dataSiswa = [];


/* ========================
   TAMPILKAN TABEL
======================== */
function tambahSiswa() {
    const nama = document.getElementById("namaSiswa").value;

    if (nama === "") {
        alert("Masukkan nama siswa");
        return;
    }

    dataSiswa.push({
        nama: nama,
        minggu1: false,
        minggu2: false,
        minggu3: false,
        minggu4: false
    });

    tampilkanData();
    document.getElementById("namaSiswa").value = "";
}

/* ========================
   SIMPAN SISWA
======================== */

function simpanSiswa() {
    const nama = document.getElementById("inputNama").value;

    if (nama.trim() === "") {
        alert("Nama tidak boleh kosong");
        return;
    }

    dataSiswa.push({
        nama: nama,
        minggu1: false,
        minggu2: false,
        minggu3: false,
        minggu4: false
    });

    tampilkanData();
    tutupPopup();
}

/* ========================
   TAMPILKAN TABEL
======================== */

function tampilkanData(data = dataSiswa) {
    let isi = "";

    data.forEach((siswa, index) => {
        isi += `
        <tr>
            <td>${index + 1}</td>
            <td>${siswa.nama}</td>

            <td>
                <input type="checkbox"
                    class="status-check"
                    ${siswa.minggu1 ? "checked" : ""}
                    onchange="ubahStatus(${index}, 'minggu1')">
            </td>

            <td>
                <input type="checkbox"
                    class="status-check"
                    ${siswa.minggu2 ? "checked" : ""}
                    onchange="ubahStatus(${index}, 'minggu2')">
            </td>

            <td>
                <input type="checkbox"
                    class="status-check"
                    ${siswa.minggu3 ? "checked" : ""}
                    onchange="ubahStatus(${index}, 'minggu3')">
            </td>

            <td>
                <input type="checkbox"
                    class="status-check"
                    ${siswa.minggu4 ? "checked" : ""}
                    onchange="ubahStatus(${index}, 'minggu4')">
            </td>
        </tr>
        `;
    });

    document.getElementById("tbodySiswa").innerHTML = isi;

    document.getElementById("totalKas").innerText =
    "Total Kas: Rp " + hitungTotalKas().toLocaleString("id-ID");
}

/* ========================
   UBAH STATUS CHECKBOX
======================== */

function ubahStatus(index, minggu) {
    dataSiswa[index][minggu] = !dataSiswa[index][minggu];
    tampilkanData();
}

/* ========================
   TOTAL KAS
======================== */
function hitungTotalKas() {
    let totalKas = 0;

    dataSiswa.forEach(siswa => {
        if (siswa.minggu1) totalKas += 5000;
        if (siswa.minggu2) totalKas += 5000;
        if (siswa.minggu3) totalKas += 5000;
        if (siswa.minggu4) totalKas += 5000;
    });
return totalKas;
}
