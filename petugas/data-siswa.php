
<h2>Data Siswa</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >
        <?php
            if(isset($_SESSION['pesan'])) {
                echo $_SESSION['pesan'];
                unset($_SESSION['pesan']);
                echo '<br/>';
            }
        ?>
        
        <div  style="display: inline-block;">
            <form class="formcaridata" action="" method="POST">
                <label for="cari-data"></label>
                <input class="inputtext" type="text" name="cari-data"  placeholder="Masukkan nisn atau nama" value="<?php if(isset($_POST['cari-data'])) { echo $_POST['cari-data'];} ?>" required>
                <input class="inputcari" type="submit" value="Cari">
            </form>
        </div>
        <br>
        <div id="scrolltable" style="">
            <!-- Tabel Data Siswa Yang terdaftar -->
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $rows = $petugas->getDataSiswaByNISNAndName($_POST['cari-data']);
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
                                    echo "<div class='divTableHead'>Jurusan</div>";
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
                                    echo "</div>";
                                echo "</div>";
                        endforeach;
                        echo "</div>";
                    }

                } else {
                    $rows = $petugas->getNumberOfAllRecords();
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
                            <div class='divTableHead'>Jurusan</div>
                        </div>
                    ";

                        if(isset($_GET['page'])) {
                            $currentPage = $_GET['page'];
                        } else {
                            $currentPage = 1;
                        }
                        $rows = $petugas->getSiswaDataNth($currentPage);
                        foreach($rows as $row) :
                        echo "
                            <div class='divTableRow'>
                                <div class='divTableCell'>".$row['row_num']."</div>
                                <div class='divTableCell'>".$row['nisn']."</div>
                                <div class='divTableCell'>".$row['nis']."</div>
                                <div class='divTableCell'>".$row['nama_lengkap']."</div>
                                <div class='divTableCell'>".$row['kelas']."</div>
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
</div>
<?php

    require_once 'footer.php'; 
?>
