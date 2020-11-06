
<h2>Laporan Pembayaran</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >
        <div style="display: inline-block;">
            <form method="POST">
                <label>Tampilkan data dari tgl.</label> 
                <input class="inputdate" type="date" value="<?= date('Y-m-01') ?>" name="tgl_awal">
                <label>sampai tgl.</label>
                <input class="inputdate" type="date" value="<?= date('Y-m-t') ?>" name="tgl_akhir">
                <button class="tombolbiru" type="submit" name="tampil" value="Tampilkan">Tampilkan</button>
            </form>
        </div>
        <div style="display: inline-block;">
            <button class="inputsubmit" id="convert" onclick="convert()">Convert ke Excel</button>
        </div>
        <br/><br/>
        <div id="scrolltable" style="">        
            <!-- Table menampilkan Data Transaksi -->
            <table class="divTable" id="table_content">
                <tr class="divTableRow">
                    <th class="divTableHead">No.</th>
                    <th class="divTableHead">ID Transaksi</th>
                    <th class="divTableHead">NISN</th>
                    <th class="divTableHead">Nama Lengkap</th>
                    <th class="divTableHead">Tgl. Bayar</th>
                    <th class="divTableHead">Bulan Bayar</th>
                    <th class="divTableHead">Tahun</th>
                    <th class="divTableHead">Nominal</th>
                    <th class="divTableHead">Nama Petugas</th>
                </tr>

                <?php
                    if (isset($_POST['tampil'])) {
                    $date1 = $_POST['tgl_awal'];
                    $date2 = $_POST['tgl_akhir'];

                    $data = $admin->getDataPembayaranPerPeriode($date1, $date2); // akan muncul error karena belum dibuat

                    $no = 1;
                    $total = 0;
                    foreach ($data as $r):
                ?>

                <tr class="divTableRow">
                    <td class="divTableCell"><?= $no++ ?></td>
                    <td class="divTableCell"><?= $r['id_pembayaran'] ?></td>
                    <td class="divTableCell"><?= $r['nisn'] ?></td>
                    <td class="divTableCell"><?= $r['nama_lengkap'] ?></td>
                    <td class="divTableCell"><?= $r['tgl_bayar'] ?></td>
                    <td class="divTableCell"><?= $r['bln_bayar'] ?></td>
                    <td class="divTableCell"><?= $r['tahun'] ?></td>
                    <td class="divTableCell"><?= $r['nominal'] ?></td>
                    <td class="divTableCell"><?= $r['nama_petugas'] ?></td>
                </tr>

                <?php
                    $total += $r['nominal'];
                    endforeach;

                    } else {echo "
                        <tr >
                            <td class='divTableHead' style='background-color: white;' colspan='10'><center>Tidak ada Data Transaksi</center>
                            </td>
                        </tr>";
                }
                ?>
            
            </table>
        </div>
    </div>
</div>

<?php
    require_once 'footer.php'; 
?>

<script src="xlsx.full.min.js"></script>
<script src="filesaver.min.js"></script>
<script type="text/javascript">
    var wb = XLSX.utils.table_to_book(document.getElementById('table_content'), {raw: true});
    var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});
    function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
    }
    function convert(){
        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'admin-laporan-pembayaran.xlsx');
    }
</script>