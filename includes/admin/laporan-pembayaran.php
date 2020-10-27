
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
                <input class="inputsubmit" type="submit" name="convert" id="convert" value="Convert ke Excel">
            </form>
        </div>


        <br/><br/>
        <div class="divTable" border="1" id="table_content">
            <div class="divTableBody">
                <div class="divTableRow">
                    <div class="divTableHead">No.</div>
                    <div class="divTableHead">ID Pembayaran</div>
                    <div class="divTableHead">NISN</div>
                    <div class="divTableHead">Nama Lengkap</div>
                    <div class="divTableHead">Tgl. Bayar</div>
                    <div class="divTableHead">Bulan Bayar</div>
                    <div class="divTableHead">Tahun</div>
                    <div class="divTableHead">Nominal</div>
                    <div class="divTableHead">Nama Petugas</div>
                </div>


                <?php
                    if (isset($_POST['tampil'])) {
                    $date1 = $_POST['tgl_awal'];
                    $date2 = $_POST['tgl_akhir'];

                    $data = $admin->getDataPembayaranPerPeriode($date1, $date2); // akan muncul error karena belum dibuat

                    $no = 1;
                    $total = 0;
                    foreach ($data as $r):
                ?>

                <div class="divTableRow">
                    <div class="divTableCell"><?= $no++ ?></div>
                    <div class="divTableCell"><?= $r['id_pembayaran'] ?></div>
                    <div class="divTableCell"><?= $r['nisn'] ?></div>
                    <div class="divTableCell"><?= $r['nama_lengkap'] ?></div>
                    <div class="divTableCell"><?= $r['tgl_bayar'] ?></div>
                    <div class="divTableCell"><?= $r['bln_bayar'] ?></div>
                    <div class="divTableCell"><?= $r['tahun'] ?></div>
                    <div class="divTableCell"><?= $r['nominal'] ?></div>
                    <div class="divTableCell"><?= $r['nama_petugas'] ?></div>
                </div>

                <?php
                    $total += $r['nominal'];
                    endforeach;

                    } else {
                    echo "
                        <div>
                        <div align=center>
                        </div>
                        </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php

    require_once 'footer.php'; 
?>

<!-- pastikan kamu sedang online -->
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