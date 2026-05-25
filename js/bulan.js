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
  "REKAP KAS BULAN " + bulanSekarang;

