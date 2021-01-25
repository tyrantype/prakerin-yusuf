
<h2>Data Siswa</h2>

<div id="kontainer-konten">
    <div id="scrolltable-wrap" >

        <div style="display: inline-block;">
            <form class="formcaridata" action="" method="POST">
                <label for="cari-data"></label>
                <input class="boxcari" type="text" name="cari-data"  placeholder="Masukkan nisn atau nama" value="<?php if(isset($_POST['cari-data'])) { echo $_POST['cari-data'];} ?>" required>
                <input class="inputcari" type="submit" value="Cari">
            </form>
        </div>
        <br>
        <a class="tombolhijau" href="?p=tambah-siswa">Tambah Data +</a>
        <br><br>

        <?php
        function is_selected_sort($sort_category, $sort_type) {
            if (isset($_GET['sort-category']) && isset($_GET['sort-type'])) {
                if ($_GET['sort-category'] === $sort_category && $_GET['sort-type'] === $sort_type) {
                    return 'selected';
                } else {
                    '';
                }
            } else {
                return '';
            }
        }

        function get_sort_type($sort_category) {
            if(isset($_GET['sort-category']) && isset($_GET['sort-type'])) {
                if(($_GET['sort-category']) === $sort_category) {
                    return $_GET['sort-type'] === 'asc' ? 'desc' : 'asc';
                } else {
                    return 'asc';
                }
            } else {
                return 'asc';
            }
        }

        function get_sort_symbol($column_name, $sort_category) {
            if(isset($_GET['sort-category']) && isset($_GET['sort-type'])) {
                if(($_GET['sort-category']) === $sort_category) {
                    return $_GET['sort-type'] === 'asc' ? "$column_name ☝️" : "$column_name 👇";
                } else {
                    return $column_name;
                }
            } else {
                return $column_name;
            }
        }
        ?>

        <label for="sort-by">Sort by</label>
        <select name="sort-by" id="sort-by">
            <option value="" selected disabled>Sort By</option>
            <option value="nisn#asc" <?= is_selected_sort('nisn', 'asc') ?> >NISN ASC</option>
            <option value="nisn#desc" <?= is_selected_sort('nisn', 'desc') ?> >NISN DESC</option>
            <option value="nis#asc" <?= is_selected_sort('nis', 'asc') ?> >NIS ASC</option>
            <option value="nis#desc" <?= is_selected_sort('nis', 'desc') ?> >NIS DESC</option>
            <option value="nama_lengkap#asc" <?= is_selected_sort('nama_lengkap', 'asc') ?> >Nama Lengkap ASC</option>
            <option value="nama_lengkap#desc" <?= is_selected_sort('nama_lengkap', 'desc') ?> >Nama Lengkap DESC</option>
            <option value="kelas#asc" <?= is_selected_sort('kelas', 'asc') ?> >Jurusan ASC</option>
            <option value="kelas#desc" <?= is_selected_sort('kelas', 'desc') ?> >Jurusan DESC</option>
            <option value="tanggal_lahir#asc" <?= is_selected_sort('tanggal_lahir', 'asc') ?> >Tanggal Lahir ASC</option>
            <option value="tanggal_lahir#desc" <?= is_selected_sort('tanggal_lahir', 'desc') ?> >Tanggal Lahir DESC</option>
            <option value="jenis_kelamin#asc" <?= is_selected_sort('jenis_kelamin', 'asc') ?> >Jenis Kelamin ASC</option>
            <option value="jenis_kelamin#desc" <?= is_selected_sort('jenis_kelamin', 'desc') ?> >Jenis Kelamin DESC</option>
        </select>
        <script>
            const sortSelect =  document.getElementById('sort-by');
            if (sortSelect !== null) {
                sortSelect.addEventListener('change', (event) => {
                    const sortCategory = event.currentTarget.value.split('#')[0];
                    const sortType = event.currentTarget.value.split('#')[1];
                    location.href = `?p=siswa&sort-category=${sortCategory}&sort-type=${sortType}`;
                });
            }
        </script>

        <div id="scrolltable">
            <?php
                if(isset($_SESSION['pesan'])) {
                    echo $_SESSION['pesan'];
                    unset($_SESSION['pesan']);
                    echo '<br/>';
                }
            ?>
           <!-- Tabel Data Siswa Yang terdaftar -->
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $rows = $admin->getDataSiswaByNISNAndName($_POST['cari-data']);
                    if(mysqli_num_rows($rows) == 0) {
                        echo "<p>Data tidak ditemukan</p>";
                    } else {
                        $i = 0;
                        echo "<div class='divTable'>";
                            echo "<div class='divTableBody'>";
                                echo "<div class='divTableRowHead'>";
                                    echo "<div class='divTableHead'>No</div>";
                                    echo "<div class='divTableHead'>Aksi</div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=nisn&sort-type=" . get_sort_type('nisn') . "'>" .get_sort_symbol('NISN', 'nisn') . "</a></div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=nis&sort-type=" . get_sort_type('nis') . "'>" .get_sort_symbol('NIS', 'nis') . "</a></div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=nama_lengkap&sort-type=" . get_sort_type('nama_lengkap') . "'>" .get_sort_symbol('Nama Lengkap', 'nama_lengkap') . "</a></div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=kelas&sort-type=" . get_sort_type('kelas') . "'>" . get_sort_symbol('Jurusan', 'kelas') . "</a></div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=tanggal_lahir&sort-type=" . get_sort_type('tanggal_lahir') . "'>" .get_sort_symbol('Tanggal Lahir', 'tanggal_lahir') . "</a></div>";
                                    echo "<div class='divTableHead'><a href='?p=siswa&sort-category=jenis_kelamin&sort-type=" . get_sort_type('jenis_kelamin') . "'>" .get_sort_symbol('Jenis Kelamin', 'jenis_kelamin') . "</a></div>";
                                    echo "<div class='divTableHead'>Nomor HP</div>";
                                    echo "<div class='divTableHead'>Email</div>";
                                    echo "<div class='divTableHead'>Alamat</div>";
                                echo "</div>";
                            echo "</div>";
                        foreach($rows as $row) :
                                echo "<div class='divTableBody'>";
                                    echo "<div class='divTableRow'>";
                                        echo "<div class='divTableCell'>".++$i."</div>";
                                        echo "<div class='divTableCell'><a class='tombolbiru' href=\"?p=ubah-siswa&nisn=" . $row['nisn'] . "\">Ubah</a> <a class='hapus' href=\"?p=hapus-siswa&nisn=" . $row['nisn'] . "\"onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a></div>";
                                        echo "<div class='divTableCell'>".$row['nisn']."</div>";
                                        echo "<div class='divTableCell'>".$row['nis']."</div>";
                                        echo "<div class='divTableCell'>".$row['nama_lengkap']."</div>";
                                        echo "<div class='divTableCell'>".$row['kelas']."</div>";
                                        echo "<div class='divTableCell'>".$row['tanggal_lahir']."</div>";
                                        echo "<div class='divTableCell'>".$row['jenis_kelamin']."</div>";
                                        $nomor_hp = empty($row['nomor_hp']) ? '-' : $row['nomor_hp'];
                                        echo "<div class='divTableCell'>".$nomor_hp."</div>";
                                        $email = empty($row['email']) ? '-' : $row['email'];
                                        echo "<div class='divTableCell'>".$email."</div>";
                                        echo "<div class='divTableCell'>Desa ".ucwords(strtolower($row['desa'])).', Kecamatan '.ucwords(strtolower($row['kecamatan'])).', '.ucwords(strtolower($row['kabupaten'])).', Provinsi '.ucwords(strtolower($row['provinsi']))."</div>";
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
                            <div class='divTableRowHead'>
                                <div class='divTableHead'>No</div>
                                <div class='divTableHead'>Aksi</div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=nisn&sort-type=" . get_sort_type('nisn') . "'>" .get_sort_symbol('NISN', 'nisn') . "</a></div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=nis&sort-type=" . get_sort_type('nis') . "'>" .get_sort_symbol('NIS', 'nis') . "</a></div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=nama_lengkap&sort-type=" . get_sort_type('nama_lengkap') . "'>" .get_sort_symbol('Nama Lengkap', 'nama_lengkap') . "</a></div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=kelas&sort-type=" . get_sort_type('kelas') . "'>" . get_sort_symbol('Jurusan', 'kelas') . "</a></div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=tanggal_lahir&sort-type=" . get_sort_type('tanggal_lahir') . "'>" .get_sort_symbol('Tanggal Lahir', 'tanggal_lahir') . "</a></div>
                                <div class='divTableHead'><a href='?p=siswa&sort-category=jenis_kelamin&sort-type=" . get_sort_type('jenis_kelamin') . "'>" .get_sort_symbol('Jenis Kelamin', 'jenis_kelamin') . "</a></div>
                                <div class='divTableHead'>Nomor HP</div>
                                <div class='divTableHead'>Email</div>
                                <div class='divTableHead'>Alamat</div>
                            </div>
                        ";

                        if(isset($_GET['page'])) {
                            $currentPage = $_GET['page'];
                        } else {
                            $currentPage = 1;
                        }

                        if (isset($_GET['sort-category']) && isset($_GET['sort-type'])) {
                            $rows = $admin->getSiswaDataNth($currentPage, $_GET['sort-category'], $_GET['sort-type']);
                        } else {
                            $rows = $admin->getSiswaDataNth($currentPage);
                        }

                        $num = 0;
                        foreach($rows as $row) :
                        $nomor_hp = empty($row['nomor_hp']) ? '-' : $row['nomor_hp'];
                        $email = empty($row['email']) ? '-' : $row['email'];
                        echo "
                            <div class='divTableRow'>
                                <div class='divTableCell'>".++$num."</div>
                                <div class='divTableCell'><a class='tombolbiru' href=\"?p=ubah-siswa&nisn=" . $row['nisn'] . "\">Ubah</a> <a class='hapus' href=\"?p=hapus-siswa&nisn=" . $row['nisn'] . "\"onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a></div>
                                <div class='divTableCell'>".$row['nisn']."</div>
                                <div class='divTableCell'>".$row['nis']."</div>
                                <div class='divTableCell'>".$row['nama_lengkap']."</div>
                                <div class='divTableCell'>".$row['kelas']."</div>
                                <div class='divTableCell'>".$row['tanggal_lahir']."</div>
                                <div class='divTableCell'>".$row['jenis_kelamin']."</div>
                                <div class='divTableCell'>".$nomor_hp."</div>
                                <div class='divTableCell'>".$email."</div>
                                <div class='divTableCell'>Desa ".ucwords(strtolower($row['desa'])).', Kecamatan '.ucwords(strtolower($row['kecamatan'])).', '.ucwords(strtolower($row['kabupaten'])).', Provinsi '.ucwords(strtolower($row['provinsi']))."</div>
                            </div>
                        ";
                    endforeach;
                    echo "</div>";
                    // pagination
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
