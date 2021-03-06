<h2>Pembayaran</h2>
<div id="kontainer-konten">
    <div id="scrolltable-wrap" >
        <form align="center" action="">
            <label for="selectSPP">Pilih tahun</label>
            <select style="width: 100px;" name="selectSPP" id="selectSPP"></select>

            <p>Tahun Pembayaran SPP : <span id="tahunSPP"></span></p>
            <p>Nominal SPP : <span id="nominalSPP"></span></p>
            <button class="btn-cetak" type="button" id="cetakSemua">Cetak semua</button>
            <br>
            <br>
        </form>
        
        <table id="tableSPP">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>    
</div>
    



<div class="modal-dialog" id="modalBayar">
    <div class="modal-content">
        <h3>Bayar SPP Bulan <span id="bayarSPPBulan"></span></h3>
        <form class="form-modal" method="POST" id="bayarSPPForm">
            <div>
                <label for="metodePembayaran">Metode Pembayaran</label>
                <select name="id_metode_pembayaran" id="metodePembayaran" required></select>
            </div>
            <div>
                <label for="namaPengirim">Nama Pengirim</label>
                <input type="text" name="nama_pengirim" id="namaPengirim" required>
            </div>
            <div>
                <label for="namaBankPengirim">Nama Bank Pengirim</label>
                <input type="text" name="nama_bank_pengirim" id="namaBankPengirim" required>
            </div>
            <div style="margin-top:10px">
                <label for="buktiPembayaran">Bukti Pembayaran</label>
                <input type="file" name="fileToUpload" id="buktiPembayaran" accept="image/*" required>
            </div>
            <figure>
                <img src="" id="previewBuktiPembayaran" alt="Bukti Pembayaran">
            </figure>
            <br>

            <div class="buttonsContainer">
                <input class="hapus" type="button" id="batalBayarDialog" value="Batal"></input>
                <input class="tombolhijau" type="submit" value="Bayar">
            </div>
        </form>
    </div>
</div>

<iframe src="" frameborder="0" id="print-area"></iframe>


<script src="assets/scripts/spp.js" defer></script>