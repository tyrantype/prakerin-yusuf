<h2>Transaksi Pembayaran</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >

        <!-- Form Pencarian siswa dengan NISN -->
        <form class="form-search-transaksi" align="center"  method="GET" action="">
            <label></label>
            <input style="width:180px;" class="inputtext" placeholder="Masukkan NISN" type="text" name="nisn" value="<?php if (isset($_GET['nisn'])) { echo $_GET['nisn']; } ?>">

            <label for="tahun"></label>
            <select style="width: 100px;" id="tahun" name="id_spp">
                <?php
                    $dt_spp = $petugas->getDataSPP();
                    foreach ($dt_spp as $row) :
                ?>
                
                <option value="<?= $row['id_spp']; ?>" <?php if (isset($_GET['id_spp']) && ($_GET['id_spp'] == $row['id_spp'])) { echo "selected"; } ?>><?= $row['tahun']; ?> </option>;
                <?php
                    endforeach;
                ?>
            </select>

            <input class="tombolhijau" type="submit" name="submit" value="Cari">
        </form><br/>
        
            <?php
                if(isset($_GET['nisn']) && isset($_GET['id_spp'])) {
                    $id_spp = $_GET['id_spp'];
                    $dt_tahun_spp = $petugas->getDataSPPbyId($id_spp);
                    $tahun_spp;
                    $nominal_spp;
                    foreach ($dt_tahun_spp as $row) :
                        $tahun_spp = $row['tahun'];
                        $nominal_spp = $row['nominal'];
                    endforeach;

                    $rows = $petugas->getDataSiswaByNISN($_GET['nisn']);
                    
                    if ($rows->num_rows > 0) {
                        foreach ($rows as $row) :
            ?>

            <!-- Bagian informasi siswa -->
            <table>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td><span id="nisn-span"><?= $row['nisn']; ?></span></td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td>:</td>
                    <td><span id="nama-span"><?= $row['nama_lengkap']; ?></span></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><span id="kelas-span"><?= $row['kelas']; ?></span></td>
                </tr>
            </table>

            <?php
                $nisn = $row['nisn'];
                endforeach;
                if(isset($_SESSION['pesan'])) {
                    echo $_SESSION['pesan'];
                    unset($_SESSION['pesan']);
                }
            ?>
            <div align="center">
                <p class="headertahun">Tahun pembayaran SPP : <span id="tahun-span"><?= $tahun_spp ?></span></p>
            </div>   

        <!-- Bagian Informasi Pembayaran -->
        <div id="scrolltable">
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRowHead">
                        <div class="divTableHead">No.</div>
                        <div class="divTableHead">Bulan</div>
                        <div class="divTableHead">Nominal</div>
                        <div class="divTableHead">Tgl. Bayar</div>
                        <div class="divTableHead">Status</div>
                        <div class="divTableHead">Keterangan</div>
                        <div class="divTableHead">Petugas</div>
                        <div align="center" class="divTableHead">Aksi</div>
                    </div>

                    <?php
                        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        $stmt_dt_pembayaran = $petugas->getDataPembayaran($row['nisn'], $id_spp);
                        $dt_pembayaran;
                        for($x = 0; $x < 12; $x++) {
                            $dt_pembayaran[] = array(
                                    "id_pembayaran" => "",
                                    "bln_bayar" => $bulan[$x],
                                    "nominal_spp" => $nominal_spp,
                                    "tgl_bayar" => "",
                                    "status" => "",
                                    "keterangan" => "",
                                    "nama_petugas" => ""
                            );
                        }
                        while ($dt_temp = mysqli_fetch_assoc($stmt_dt_pembayaran)) :
                            $key = array_search($dt_temp['bln_bayar'], array_column($dt_pembayaran, "bln_bayar"));
                            $dt_pembayaran[$key]['id_pembayaran'] = $dt_temp['id_pembayaran'];
                            $dt_pembayaran[$key]['tgl_bayar'] = $dt_temp['tgl_bayar'];
                            $dt_pembayaran[$key]['status'] = $dt_temp['status'];
                            $dt_pembayaran[$key]['keterangan'] = "<div class='lunas' >$dt_temp[keterangan]</div>";
                            $dt_pembayaran[$key]['nama_petugas'] = $dt_temp['nama_petugas'];
                        endwhile;
                        for($x = 0; $x < 12; $x++) {
                    ?>

                    <div class="divTableRow">
                        <div class="divTableCell"><?= $x+1; ?></div>
                        <div class="divTableCell"><?= $dt_pembayaran[$x]['bln_bayar']; ?></div>
                        <div class="divTableCell">Rp. <?= $dt_pembayaran[$x]['nominal_spp']; ?></div>
                        <div class="divTableCell"><?= $dt_pembayaran[$x]['tgl_bayar']; ?></div>
                        <div class="divTableCell"><?= $dt_pembayaran[$x]['status']; ?></div>
                        <div class="divTableCell"><?= $dt_pembayaran[$x]['keterangan']; ?></div>
                        <div class="divTableCell"><?= $dt_pembayaran[$x]['nama_petugas']; ?></div>
                        <div class="divTableCell">
                            <?php
                                if(empty($dt_pembayaran[$x]['tgl_bayar'])) {
                                    echo '<a class="tombolhijau btn-detail">Bayar</a> ';
                                } else {
                                    echo '<a class="tombolbiru btn-detail">Detail</a> ';
                                    if ($dt_pembayaran[$x]['status'] === 'success') {
                                        echo '<a class="tombolbiru" href="cetak-transaksi-perbulan.php?nisn='.$_GET['nisn'].'&id_pembayaran='.$dt_pembayaran[$x]['id_pembayaran'].'">Cetak</a> ';
                                    }
                                    echo '<a class="hapus" align="center" href="proses-transaksi.php?act=batal&id_pembayaran='.$dt_pembayaran[$x]['id_pembayaran'].'">Hapus</a> ';
                                }
                            ?>
                        </div>
                    </div>

                    <?php
                        }
                        } else {
                            echo "NIS tidak ditemukan";
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-dialog" id="modal-detail-pembayaran">
    <div class="modal-content">
        <p><strong>Detail Pembayaran</strong></p>
        <form method="post" id="detail-pembayaran-form">
            <label for="nama">Nama</label>
            <input type="text" id="nama" readonly>
            <br>

            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" readonly>
            <br>

            <label for="tahun">Tahun</label>
            <input type="text" id="tahun-bayar" readonly>
            <input type="hidden" name="id_spp" required>
            <br>

            <label for="bulan-bayar">Bulan</label>
            <input type="text" name="bln_bayar" id="bulan-bayar" readonly required>
            <br>

            <label for="tanggal-bayar">Tanggal Bayar</label>
            <input type="datetime-local" name="tgl_bayar" id="tanggal-bayar" required>
            <br>

            <label for="metode-pembayaran">Metode Pembayaran</label>
            <select name="id_metode_pembayaran" id="metode-pembayaran" required>
                <option value="" selected disabled>Pilih metode pembayaran</option>
            </select>
            <br>
            
            <div id="nama-pengirim-group">
                <label for="nama-pengirim">Nama Pengirim</label>
                <input type="text" name="nama_pengirim" id="nama-pengirim">
                <br>
            </div>

            <div id="nama-bank-pengirim-group">
                <label for="nama-bank-pengirim">Nama Bank Pengirim</label>
                <input type="text" name="nama_bank_pengirim" id="nama-bank-pengirim">
                <br>
            </div>

            <div id="bukti-pembayaran-group">
                <label for="bukti-pembayaran">Bukti Pembayaran</label>
                <input type="file" name="fileToUpload" id="bukti-pembayaran" accept="image/*">
                <br>

                <figure>
                    <img src="" id="preview-bukti-pembayaran" alt="Bukti Pembayaran">
                </figure>
                <br>
            </div>

            <div id="status-keterangan-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="" selected>Pilih status</option>
                    <option value="success">Success</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>

                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan">
                <br>
            </div>

            <div style="display: flex; justify-content: space-between">
                <input type="button" id="batal-bayar" value="Batal">
                <input type="submit" value="Simpan">
            </div>
        </form> 
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', event => {
        // menghilangkan dialog-modal saat klik area diluar dialog-content 
        Array.from(document.getElementsByClassName('modal-dialog')).forEach(elm => {
            elm.addEventListener('click', event => {
                if(event.target === event.currentTarget) {
                    closeModalDetailPembayaran();
                }
            });
        });

        // menampilkan modal detail pembayaran saat klik tombol bayar atau detail
        Array.from(document.getElementsByClassName('btn-detail')).forEach(elm => {
            elm.addEventListener('click', event => {
                const row = event.target.closest('.divTableRow').children;
                if (row.item(3).textContent === "") {
                    method = 'insert';
                    showModalDetailPembayaran('new', row);
                } else {
                    method = 'update';
                    showModalDetailPembayaran('exist', row);
                }
            });
        });

        // menampilkan atau menghilangkan nama pengirim, nama bank pengirim, bukti pembayaran, status, dan keterangan saat select bukti-pembayaran diganti
        document.getElementById('metode-pembayaran').addEventListener('change', event => {
            if(document.getElementById('metode-pembayaran').value === '4' || document.getElementById('metode-pembayaran').selectedIndex === 0) {
                ubahMetodePembayaran('Tunai');
            } else {
                ubahMetodePembayaran('Nontunai');
            }
        });

        // menampilkan preview gambar
        document.getElementById('bukti-pembayaran').addEventListener('change', event => {
            document.getElementById('preview-bukti-pembayaran').src = window.URL.createObjectURL(event.target.files[0]);
        });

        // menghilangkan dialog-modal saat klik tombol batal
        document.getElementById('batal-bayar').addEventListener('click', event => {
            closeModalDetailPembayaran();
        });

        document.getElementById('status').addEventListener('change', event => {
            if (document.getElementById('status').value === 'success') {
                document.getElementById('keterangan').value = 'Lunas';
            } else {
                document.getElementById('keterangan').value = '';
            }
        });

        // submit form
        document.forms['detail-pembayaran-form'].addEventListener('submit', event => {
            event.preventDefault();
            submitForm();
        });

        getMetodePembayaran();
    });

    let method = null;

    function showModalDetailPembayaran(mode, row) {
        document.querySelector('body').style.overflow = 'hidden';
        document.getElementById('nisn').value = document.getElementById('nisn-span').textContent;
        document.getElementById('nama').value = document.getElementById('nama-span').textContent;
        document.getElementById('tahun-bayar').value = document.getElementById('tahun-span').textContent;
        document.forms['detail-pembayaran-form']['id_spp'].value = document.getElementById('tahun').value;
        document.getElementById('bulan-bayar').value = row.item(1).textContent;
        
        if(mode === 'new') {
            let now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.forms['detail-pembayaran-form']['tanggal-bayar'].value = now.toISOString().slice(0,16);
        } else if (mode === 'exist') {
            getDetailPembayaran(document.getElementById('nisn-span').textContent, document.getElementById('tahun').value, row.item(1).textContent);
        }
        document.getElementById('modal-detail-pembayaran').style.display = 'grid';
    }

    function closeModalDetailPembayaran() {
        document.forms['detail-pembayaran-form'].reset();
        document.getElementById('preview-bukti-pembayaran').src = '';
        ubahMetodePembayaran('Tunai');
        document.getElementById('modal-detail-pembayaran').style.display = 'none';
        document.querySelector('body').style.overflow = 'auto';
    }

    function ubahMetodePembayaran(metode) {
        const namaPengirimGroup = document.getElementById('nama-pengirim-group');
        const namaBankPengirimGroup = document.getElementById('nama-bank-pengirim-group');
        const buktiPembayaran = document.getElementById('bukti-pembayaran-group');
        const statusKeterangan = document.getElementById('status-keterangan-group');
        let display = null;

        if(metode === 'Tunai') {
            display = 'none';
            document.getElementById('nama-pengirim').value = '';
            document.getElementById('nama-bank-pengirim').value = '';
            document.getElementById('status').selectedIndex = 0;
            document.getElementById('keterangan').value = '';
            document.getElementById('status').value = 'success';
            document.getElementById('keterangan').value = 'Lunas';
        } else {
            display = 'block';
            document.getElementById('status').selectedIndex = 0;
            document.getElementById('keterangan').value = '';
        }

        namaPengirimGroup.style.display = display;
        namaBankPengirimGroup.style.display = display;
        buktiPembayaran.style.display = display;
        statusKeterangan.style.display = display;
    }

    function getMetodePembayaran() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'api/get/?q=metode-pembayaran');
        xhr.onload = () => {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                const select = document.getElementById('metode-pembayaran');
                response.data.forEach(row => {
                    const option = document.createElement('option');
                    option.value = row.id;
                    option.textContent = row.nama_bank === 'Tunai' ? 'Tunai' : row.nama_bank + ' / ' + row.nomor + ' / ' + row.nama_pemilik_rekening;
                    select.appendChild(option);
                });
            }
        };
        xhr.send();
    }

    function getDetailPembayaran(nisn, idSPP, blnBayar) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `api/get/?q=detail-pembayaran&nisn=${nisn}&id_spp=${idSPP}&bln_bayar=${blnBayar}`);
        xhr.onload = () => {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                document.getElementById('tanggal-bayar').value = response.data.tgl_bayar.replace(' ', 'T').substring(0, 16);
                document.getElementById('metode-pembayaran').value = response.data.id_metode_pembayaran;
                if(response.data.id_metode_pembayaran !== '4') {
                    document.getElementById('nama-pengirim').value = response.data.nama_pengirim;
                    document.getElementById('nama-bank-pengirim').value = response.data.nama_bank_pengirim;
                    document.getElementById('status').value = response.data.status;
                    document.getElementById('preview-bukti-pembayaran').src = `../siswa/assets/images/bukti-pembayaran/${response.data.id_pembayaran}.jpg`;
                    document.getElementById('keterangan').value = response.data.keterangan;
                    
                    document.getElementById('nama-pengirim-group').style.display = 'block';
                    document.getElementById('nama-bank-pengirim-group').style.display = 'block';
                    document.getElementById('bukti-pembayaran-group').style.display = 'block';
                    document.getElementById('status-keterangan-group').style.display = 'block';
                }
            }
        };
        xhr.send();
    }

    function submitForm() {
        const xhr = new XMLHttpRequest();
        const formData = new FormData(document.forms['detail-pembayaran-form']);
        formData.set('tgl_bayar', document.getElementById('tanggal-bayar').value.replace('T', ' '));
        xhr.open('POST', 'api/post/?q=bayar-' + method);
        xhr.onload = () => {
            const response = JSON.parse(xhr.responseText);
            alert(response.data.message);
            if(response.status === 'success') {
                window.location.reload();
            }
        };
        xhr.send(formData);
    }
</script>
<?php
    require_once 'footer.php';
?>