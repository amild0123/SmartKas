
<body>
    <div class="crop">
        <h1 id="judulBulan" class="judulBulan"></h1>   

            <!-- Search -->
        <div class="top-bar">
            <input  class="search-container" 
                type="text" id="searchInput" 
                placeholder="         Cari nama siswa..." 
                onkeyup="cariSiswa()">
            <p id="pesan"></p>

            <button onclick="bukaPopup()" style="font-size: 20px;">
                <img src="asset/PlusSquareDotted.png" alt="plus" class="plus-icon"> 
                Tambah Siswa
            </button>

            <div class="total-kas-container" id="totalKas">
                Total Kas: RP 0
            </div>
        </div>
                <div id="popup" class="popup" style="z-index: 9;">
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
        <!-- </div> -->

        

        <!-- tabel -->
        <div class="container">
            <div class="table-container">
                <table>
                    <thead style="z-index: 1;">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Minggu 1</th>
                            <th>Minggu 2</th>
                            <th>Minggu 3</th>
                            <th>Minggu 4</th>
                        </tr>
                    </thead>

                    <tbody id="tbodySiswa">
                    </tbody>
                </table>
            </div>

            <div class="columRekap">
                <div class="rekapMingguan-container">
                    <h2>Rekap Mingguan 1</h2>
                    <div id="recapMingguan"></div>
                </div>

                <div class="rekapMingguan-container">
                    <h2>Rekap Mingguan 2</h2>
                    <div id="recapMingguan"></div>
                </div>

                <div class="rekapMingguan-container">
                    <h2>Rekap Mingguan 3</h2>
                    <div id="recapMingguan"></div>
                </div>
            </div>
            
        </div>
    
    </div>


        <script src="js/PageInput.js"></script> <!-- Script utama -->
        
</body>
</html>