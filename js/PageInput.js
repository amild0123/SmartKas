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
    document.getElementById("absen").value = "";
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
  let nama = document.getElementById("inputNama").value;
  let absen = document.getElementById("absen").value;

  fetch("database/simpanSiswa.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "nama=" + encodeURIComponent(nama) + "&absen=" + encodeURIComponent(absen)
  })
  .then(response => response.text())
  .then(data => {
    if (data == "success") {
      tutupPopup();   // popup ketutup
      loadData();     // tabel refresh
    } else {
      alert(data);
    }
  })
  .catch(error => console.error(error));
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

/* ========================
   LoAD DATA DARI DATABASE
======================== */
function loadData() {
  fetch("database/tampil.php")
    .then(res => res.text())
    .then(html => {
      document.getElementById("tbodySiswa").innerHTML = html;
    })
    .catch(err => console.error("Error load data:", err));
}

// panggil saat halaman pertama kali dibuka
window.onload = loadData;

/* ========================
   Simpan Checkbox
======================== */
function simpanCheckbox() {
  const checkboxes = document.querySelectorAll("#tbodySiswa input[type=checkbox]");
  let data = [];

  checkboxes.forEach((cb, i) => {
    data.push({
      id: cb.dataset.id, // pastikan di tampil.php ada data-id
      minggu: cb.dataset.minggu,
      status: cb.checked ? 1 : 0
    });
  });

  fetch("database/simpanCheckbox.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  })
  .then(res => res.text())
  .then(res => {
    alert(res);
    loadData();
  });
}



