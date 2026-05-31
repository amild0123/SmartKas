<body>
  <div class="crop">
    <h1 id="judulBulan" class="judulBulan">INPUT KAS BULAN JANUARI</h1>

    <!-- Top bar -->
    <div class="top-bar">
      <input
        class="search-container"
        type="text"
        id="searchInput"
        placeholder="Search for student"
        onkeyup="cariSiswa()"
      >
      <button onclick="bukaPopup()" class="btn-modern">
        <img src="asset/PlusSquareDotted.png" alt="plus" class="plus-icon">
        Tambah Siswa
      </button>
      <div class="total-kas-container" id="totalKas">Rp. 0</div>
    </div>

    <!-- Popup tambah siswa -->
    <div id="popup" class="popup">
      <div class="popup-content">
        <h3>Tambah Data Siswa</h3>
        <input type="text" id="inputNama" placeholder="Masukkan nama siswa">
        <input type="number" id="absen" placeholder="Masukkan nomor absen">
        <div class="popup-btn">
          <button onclick="simpanSiswa()">Simpan</button>
          <button onclick="tutupPopup()">Batal</button>
        </div>
      </div>
    </div>

    <!-- Tabel dan rekap -->
    <div class="container">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>No. Absen</th>
              <th>Nama Lengkap</th>
              <th>Minggu 1</th>
              <th>Minggu 2</th>
              <th>Minggu 3</th>
              <th>Minggu 4</th>
            </tr>
          </thead>
          <tbody id="tbodySiswa"></tbody>
        </table>
        <button class="btn-save" onclick="simpanCheckbox()">💾 Simpan</button>
      </div>

      <div class="columRekap" id="rekapContainer"></div>
    </div>

    <!-- Tombol buka popup detail kas -->
    <div class="bottom-bar">
      <button onclick="bukaPopupDetail()" class="btn-detail">
        Masukkan Detail Kas
      </button>
    </div>

    <!-- Popup detail kas -->
    <div id="popupDetail" class="popup">
      <div class="popup-content">
        <h2>Input Detail Kas</h2>
        <form>
          <label for="tanggal">Tanggal</label>
          <input type="date" id="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>

          <label for="keterangan">Keterangan</label>
          <input type="text" id="keterangan" placeholder="Contoh : Print ulangan">

          <label for="jenis">Kategori</label>
          <select id="jenis">
            <option value="">Pilihan Kategori</option>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
          </select>

          <label for="jumlah">Nominal</label>
          <input type="number" id="jumlah" placeholder="Contoh : 7500">

          <div class="popup-btn">
            <button type="button" onclick="simpanKas()">Tambah Data</button>
            <button type="button" onclick="tutupPopupDetail()">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="js/PageInput.js"></script>
</body>
