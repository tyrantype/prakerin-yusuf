
<h2>Data Petugas</h2>

<div id="kontainer-konten">
    <div>
        <a class="tombolhijau" href="?p=tambah-petugas">Tambah Data +</a>
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

        <!-- Format Awal Table -->
        <!-- <table border="1">
            <tr>
                <th>No.</th>
                <th>Nama Petugas</th>
                <th>Username</th>
               <th>Password</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>

            <//?php 
                $no = 1;
                $rows = $admin->getAllDataPetugas();

                foreach ($rows as $row) :
            ?>

            <tr>
                <td><//?= $no++; ?></td>
                <td><//?= $row['nama_petugas']; ?></td>
                <td><//?= $row['username']; ?></td>
                <td type="hidden"><//?= $row['password']; ?></td>
                <td><//?= $row['level']; ?></td>
                <td><a href="?p=ubah-petugas&id=<//?= $row['id_petugas']; ?>">Ubah</a> | <a href="?p=hapus-petugas&id=<//?= $row['id_petugas']; ?>">Hapus</a></td>
            </tr>

            <//?php
                endforeach;
            ?>
        </table> -->
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>