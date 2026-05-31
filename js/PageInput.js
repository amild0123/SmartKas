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
  const keyword = document.getElementById("searchInput").value;

  fetch("database/searchSiswa.php?keyword=" + encodeURIComponent(keyword))
    .then(res => res.text())
    .then(html => {
      document.getElementById("tbodySiswa").innerHTML = html;
    })
    .catch(err => console.error("Error search:", err));
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
      rekapMingguan(); // panggil di sini
    })
    .catch(err => console.error("Error load data:", err));
}

// panggil saat halaman pertama kali dibuka
window.onload = function() {
  loadData();        // tampilkan tabel
  generateRekapBoxes(); // buat box sesuai minggu
  rekapMingguan();   // isi data rekap
};

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

/* ========================
    Rekap Muncul perminggu
======================== */
function generateRekapBoxes(data) {
  const sekarang = new Date();
  const mingguKe = Math.min(Math.ceil(sekarang.getDate() / 7), 4);

  const container = document.getElementById("rekapContainer");
  container.innerHTML = "";

  for (let i = 1; i <= mingguKe; i++) {
    const box = document.createElement("div");
    box.className = "rekapMingguan-container";
    box.innerHTML = `
      <h2>Rekap Minggu ${i}</h2>
      <p>Keseluruhan : Rp ${data["minggu"+i].keseluruhan.toLocaleString("id-ID")}</p>
      <p>Pemasukan   : Rp ${data["minggu"+i].pemasukan.toLocaleString("id-ID")}</p>
      <p>Jumlah Nunggak : Rp ${data["minggu"+i].nunggak.toLocaleString("id-ID")}</p>
    `;
    container.appendChild(box);
  }
}

/* ========================
    Rekap Mingguan
======================== */
let lastTotalKas = 0;

function rekapMingguan() {
  fetch("database/rekap.php")
    .then(res => res.json())
    .then(data => {
      generateRekapBoxes(data);

      // animasi angka naik
      animateTotalKas(lastTotalKas, data.totalKas);
      lastTotalKas = data.totalKas;
    })
    .catch(err => console.error("Error rekap:", err));
}


/* ========================
    Animasi Total Kas
======================== */
function animateTotalKas(oldValue, newValue) {
  const el = document.getElementById("totalKas");
  const duration = 1000; // durasi animasi (ms)
  const frameRate = 30;  // kecepatan frame
  const steps = duration / frameRate;
  const increment = (newValue - oldValue) / steps;
  let current = oldValue;
  let count = 0;

  const timer = setInterval(() => {
    current += increment;
    el.innerText = "Total Kas: Rp " + Math.round(current).toLocaleString("id-ID");
    count++;
    if (count >= steps) {
      clearInterval(timer);
      // pastikan nilai akhir akurat
      el.innerText = "Total Kas: Rp " + newValue.toLocaleString("id-ID");
      el.classList.add("updated");
      setTimeout(() => el.classList.remove("updated"), 500);
    }
  }, frameRate);
}

/* ========================
    Popup Detail Kas
======================== */
function bukaPopupDetail() {
  document.getElementById("popupDetail").style.display = "flex";
}

function tutupPopupDetail() {
  document.getElementById("popupDetail").style.display = "none";
  document.getElementById("keterangan").value = "";
  document.getElementById("jumlah").value = "";
  document.getElementById("jenis").selectedIndex = 0;
}
function simpanKas() {
  let tanggal = document.getElementById("tanggal").value;
  let keterangan = document.getElementById("keterangan").value;
  let jenis = document.getElementById("jenis").value;
  let jumlah = document.getElementById("jumlah").value;

  fetch("database/simpanKas.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body:
      "tanggal=" + encodeURIComponent(tanggal) +
      "&keterangan=" + encodeURIComponent(keterangan) +
      "&jenis=" + encodeURIComponent(jenis) +
      "&jumlah=" + encodeURIComponent(jumlah)
  })
  .then(response => response.text())
  .then(data => {
    if (data === "success") {
      tutupPopupDetail();   // popup ketutup
      rekapMingguan();      // refresh tampilan rekap
    } else {
      alert(data);
    }
  })
  .catch(error => console.error("Error simpanKas:", error));
}


