
<h2>Data SPP</h2>
<div id="kontainer-konten">
    <div id="konten">
        <a class="tombolhijau" href="?p=tambah-spp">Tambah Data +</a>
        <br><br>

        <?php
            if(isset($_SESSION['pesan'])) {
                echo $_SESSION['pesan'];
                unset($_SESSION['pesan']);
                echo '<br/>';
            }
        ?>

        <div class="divTable">
            <div class="divTableBody">
                <div class="divTableRow">
                    <div class="divTableHead">No.</div>
                    <div class="divTableHead">Tahun</div>
                    <div class="divTableHead">Nominal</div>
                    <div class="divTableHead">Aksi</div>
                </div>
                <?php
                    $no = 1;
                    $spp = $admin->getDataSPP();
                    while($dt_spp = mysqli_fetch_assoc($spp)) {
                ?>
                <div class="divTableRow">
                    <div class="divTableCell"><?= $no++; ?></div>
                    <div class="divTableCell"><?= $dt_spp['tahun']; ?></div>
                    <div class="divTableCell"><?= $dt_spp['nominal']; ?></div>
                    <div class="divTableCell"><a class="tombolbiru" href="?p=ubah-spp&id=<?= $dt_spp['id_spp'];?>">Ubah</a> <a class="hapus" href="?p=hapus-spp&id=<?= $dt_spp['id_spp'];?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a></div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- Desain Tabel Awal -->
        <!-- <table border="1">
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>

            tampilkan data spp
            <//?php
                $no = 1;
                $spp = $admin->getDataSPP();
                while($dt_spp = mysqli_fetch_assoc($spp)) {
            ?>

            <tr>
                <td><//?= $no++; ?></td>
                <td><//?= $dt_spp['tahun']; ?></td>
                <td><//?= $dt_spp['nominal']; ?></td>
                <td><a href="?p=ubah-spp&id=<//?= $dt_spp['id_spp'];?>">Ubah</a>|<a href="?p=hapus-spp&id=<//?= $dt_spp['id_spp'];?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a></td>
            </tr>

            <//?php
            }
            ?>

        </table> -->
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>