<h2>Transaksi Pembayaran</h2>

<div id="kontainer-konten">
    <div>
        <form align="center"  method="GET" action="">
            <label></label>
            <input style="width:150px;" class="inputtext" placeholder="Masukkan NISN" type="text" name="nisn" value="<?php if (isset($_GET['nisn'])) { echo $_GET['nisn']; } ?>">

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

        <table>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><?= $row['nisn']; ?></td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td><?= $row['nama_lengkap']; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= $row['kelas']; ?></td>
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
            <p class="headertahun">Tahun pembayaran SPP : <?= $tahun_spp ?> 
                <?php
                    // $nisn = $row['nisn'];
                    // endforeach;
                    // if(isset($_SESSION['pesan'])) {
                    //     echo $_SESSION['pesan'];
                    //     unset($_SESSION['pesan']);
                    // }
                ?>
            </p>
        </div>     
        <div class="divTable">
            <div class="divTableBody">
                <div class="divTableRow">
                    <div class="divTableHead">No.</div>
                    <div class="divTableHead">Bulan</div>
                    <div class="divTableHead">Nominal</div>
                    <div class="divTableHead">Tgl. Bayar</div>
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
                                "keterangan" => "",
                                "nama_petugas" => ""
                        );
                    }
                    while ($dt_temp = mysqli_fetch_assoc($stmt_dt_pembayaran)) :
                        $key = array_search($dt_temp['bln_bayar'], array_column($dt_pembayaran, "bln_bayar"));
                        $dt_pembayaran[$key]['id_pembayaran'] = $dt_temp['id_pembayaran'];
                        $dt_pembayaran[$key]['tgl_bayar'] = $dt_temp['tgl_bayar'];
                        $dt_pembayaran[$key]['keterangan'] = '<div class="lunas" >Lunas</div>';
                        $dt_pembayaran[$key]['nama_petugas'] = $dt_temp['nama_petugas'];
                    endwhile;
                    for($x = 0; $x < 12; $x++) {
                ?>

                <div class="divTableRow">
                    <div class="divTableCell"><?= $x+1; ?></div>
                    <div class="divTableCell"><?= $dt_pembayaran[$x]['bln_bayar']; ?></div>
                    <div class="divTableCell"><?= $dt_pembayaran[$x]['nominal_spp']; ?></div>
                    <div class="divTableCell"><?= $dt_pembayaran[$x]['tgl_bayar']; ?></div>
                    <div class="divTableCell"><?= $dt_pembayaran[$x]['keterangan']; ?></div>
                    <div class="divTableCell"><?= $dt_pembayaran[$x]['nama_petugas']; ?></div>
                    <div class="divTableCell">
                        <?php
                            if(empty($dt_pembayaran[$x]['tgl_bayar'])) {
                                echo '<a class="tombolhijau" href="proses-transaksi.php?act=bayar&nisn='.$_GET['nisn'].'&id_spp='.$_GET['id_spp'].'&nmr_bln='.$x.'">Bayar</a>';
                            } else {
                                echo '<a class="tombolbiru" href="cetak-transaksi-perbulan.php?nisn='.$_GET['nisn'].'&id_pembayaran='.$dt_pembayaran[$x]['id_pembayaran'].'">Cetak</a> <a class="hapus" align="center" href="proses-transaksi.php?act=batal&id_pembayaran='.$dt_pembayaran[$x]['id_pembayaran'].'">Batal</a> ';
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

<?php
    require_once 'footer.php';
?>