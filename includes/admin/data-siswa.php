
<h2>Data Siswa</h2>

<div id="kontainer-konten">
    <div class="">
        <?php
            if(isset($_SESSION['pesan'])) {
                echo $_SESSION['pesan'];
                unset($_SESSION['pesan']);
                echo '<br/>';
            }
        ?>
        <!-- Tabel Data Siswa Yang terdaftar -->
        <div  style="display: inline-block;">
            <form class="formcaridata" action="" method="POST">
                <label for="cari-data"></label>
                <input class="inputtext" type="text" name="cari-data"  placeholder="Masukkan nisn atau nama" value="<?php if(isset($_POST['cari-data'])) { echo $_POST['cari-data'];} ?>" required>
                <input class="inputcari" type="submit" value="Cari">
            </form>
        </div>
        <br>

        <a class="tombolhijau" href="?p=tambah-siswa">Tambah Data +</a>
        <br><br>
        
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $rows = $admin->getDataSiswaByNISNAndName($_POST['cari-data']);
                if(mysqli_num_rows($rows) == 0) {
                    echo "<p>Data tidak ditemukan</p>";
                } else {
                    $i = 0;
                    echo "<div class='divTable'>";
                        echo "<div class='divTableBody'>";
                            echo "<div class='divTableRow'>";
                                echo "<div class='divTableHead'>No</div>";
                                echo "<div class='divTableHead'>NISN</div>";
                                echo "<div class='divTableHead'>NIS</div>";
                                echo "<div class='divTableHead'>Nama Lengkap</div>";
                                echo "<div class='divTableHead'>Kelas</div>";
                                echo "<div class='divTableHead'>Aksi</div>";
                            echo "</div>";
                        echo "</div>";
                    foreach($rows as $row) :
                            echo "<div class='divTableBody'>";
                                echo "<div class='divTableRow'>";
                                    echo "<div class='divTableCell'>".++$i."</div>";
                                    echo "<div class='divTableCell'>".$row['nisn']."</div>";
                                    echo "<div class='divTableCell'>".$row['nis']."</div>";
                                    echo "<div class='divTableCell'>".$row['nama_lengkap']."</div>";
                                    echo "<div class='divTableCell'>".$row['kelas']."</div>";
                                    echo "<div class='divTableCell'><a class='tombolbiru' href=\"?p=ubah-siswa&nisn=" . $row['nisn'] . "\">Ubah</a> <a class='hapus' href=\"?p=hapus-siswa&nisn=" . $row['nisn'] . "\"onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a></div>";
                                echo "</div>";
                            echo "</div>";
                    endforeach;
                    echo "</div>";
                }

            } else {
                $rows = $admin->getNumberOfAllRecords();
                $row = mysqli_fetch_row($rows);
                $totalRecords = $row[0];
                $totalPages = ceil($totalRecords / 10);
                
                echo "
                <div class='divTable'>
                    <div <div class='divTableBody'>
                        <div class='divTableHead'>No</div>
                        <div class='divTableHead'>NISN</div>
                        <div class='divTableHead'>NIS</div>
                        <div class='divTableHead'>Nama Lengkap</div>
                        <div class='divTableHead'>Kelas</div>
                        <div class='divTableHead'>Aksi</div>
                    </div>
                ";

                    if(isset($_GET['page'])) {
                        $currentPage = $_GET['page'];
                    } else {
                        $currentPage = 1;
                    }
                    $rows = $admin->getSiswaDataNth($currentPage);
                    foreach($rows as $row) :
                    echo "
                        <div class='divTableRow'>
                            <div class='divTableCell'>".$row['row_num']."</div>
                            <div class='divTableCell'>".$row['nisn']."</div>
                            <div class='divTableCell'>".$row['nis']."</div>
                            <div class='divTableCell'>".$row['nama_lengkap']."</div>
                            <div class='divTableCell'>".$row['kelas']."</div>
                            <div class='divTableCell'><a class='tombolbiru' href=\"?p=ubah-siswa&nisn=" . $row['nisn'] . "\">Ubah</a> <a class='hapus' href=\"?p=hapus-siswa&nisn=" . $row['nisn'] . "\"onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a></div>
                        </div>
                    ";
                endforeach;
                echo "</div>";
                echo '<div class="pagination">';
                for($i = 1; $i <= $totalPages; $i++) {
                    if($i == $currentPage) {
                        echo '<span>'.$i.'</span>';
                    } else {
                        echo '<span><a href="index.php?p=siswa&page='.$i.'">'.$i.'</a></span>';
                    }
                }
                echo '</div>';
            }
        ?>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>
