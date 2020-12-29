
<h2>Data SPP</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >
        <a class="tombolhijau" href="?p=tambah-spp">Tambah Data +</a>
        <br><br>

        <div id="scrolltable" style="">
            <?php
                if(isset($_SESSION['pesan'])) {
                    echo $_SESSION['pesan'];
                    unset($_SESSION['pesan']);
                    echo '<br/>';
                }
            ?>

            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRowHead">
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
                        <div class="divTableCell">Rp. <?= $dt_spp['nominal']; ?></div>
                        <div class="divTableCell"><a class="tombolbiru" href="?p=ubah-spp&id=<?= $dt_spp['id_spp'];?>">Ubah</a> <a class="hapus" href="?p=hapus-spp&id=<?= $dt_spp['id_spp'];?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a></div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>