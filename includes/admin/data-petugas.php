
<h2>Data Petugas</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >
        
        <a class="tombolhijau" href="?p=tambah-petugas">Tambah Data +</a>
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
                        <div class="divTableHead">Nama Petugas</div>
                        <div class="divTableHead">Username</div>
                        <div class="divTableHead">Level</div>
                        <div align="center" class="divTableHead">Aksi</div>
                    </div>
                    <?php 
                        $no = 1;
                        $rows = $admin->getAllDataPetugas();

                        foreach ($rows as $row) :
                    ?>
                    <div class="divTableRow">
                        <div class="divTableCell"><?= $no++; ?></div>
                        <div class="divTableCell"><?= $row['nama_petugas']; ?></div>
                        <div class="divTableCell"><?= $row['username']; ?></div>
                        <!-- <div type="hidden"><?= $row['password']; ?></div> -->
                        <div class="divTableCell"><?= $row['level']; ?></div>
                        <div class="divTableCell"><a class="tombolbiru" href="?p=ubah-petugas&id=<?= $row['id_petugas']; ?>">Ubah</a> <a class="hapus" href="?p=hapus-petugas&id=<?= $row['id_petugas']; ?>">Hapus</a></div>

                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php

    require_once 'footer.php'; 
?>