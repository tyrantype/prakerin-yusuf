
<h2>Laporan Pembayaran</h2>

<div id="kontainer-konten">
    <div class="">
        <div style="display: inline-block;">
            <form method="POST">
                <label>Tampilkan data dari tgl.</label> 
                <input class="inputdate" type="date" name="tgl_awal">
                <label>sampai tgl.</label>
                <input class="inputdate" type="date" name="tgl_akhir">
                <button class="tombolbiru" type="submit" name="tampil" value="Tampilkan">Tampilkan</button>
            </form>
        </div>
        <div style="display: inline-block;">
            <form action="export.php" method="POST" id="convert_form">
                <input type="hidden" name="file_content" id="file_content">
                <button class="inputsubmit" type="submit" name="convert" id="convert" value="Convert ke Excel">Convert ke Excel</button>
            </form>
        </div>
        <br/><br/>

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

<?php
    require_once 'footer.php'; 
?>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#convert').click(function() {
                var table_content = '<table>';
                table_content += $('#table_content').html();
                table_content += '</table>';
                $('#file_content').val(table_content);
            $('#convert_form').html();
        });
    });
</script>