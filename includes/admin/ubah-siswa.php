<?php
    require_once 'header.php';
?>
<?php
    if(isset($_POST['submit'])) {
        if($admin->ubahDataSiswa($_POST['nis'], $_POST['nama'], $_POST['kelas'], $_POST['nisn']))
        {
            header('Location: ?p=siswa');
            $_SESSION['pesan'] = "Data Siswa berhasil diubah";
        } else {
            header('Location: ?p=siswa');
            $_SESSION['pesan'] = "Data Siswa gagal diubah";
        }
    }

    if(isset($_GET['nisn'])) {
        $dt_siswa = $admin->getDataSiswaByNisn($_GET['nisn']);

        foreach ($dt_siswa as $row) :
?>

<h2>Ubah Data Siswa</h2>

<div id="kontainer-konten">
    <div class="kontainerform">
        <form method="post">
            <input type="hidden" name="nisn" id="nisn" required value="<?= $row['nisn']; ?>"><br>
            <label for="nis">NIS</label><br>
            <input class="inputtext" type="text" name="nis" id="nis" required value="<?= $row['nis']; ?>"><br>
            <label for="nama">Nama Lengkap</label><br>
            <input class="inputtext" type="text" name="nama" id="nama" required value="<?= $row['nama_lengkap']; ?>">
            <br>
            <label for="kelas">Jurusan</label><br>
            <select name="kelas" id="kelas">
                <?php
                    echo "<option value='". $row['kelas'] ."' disabled selected>" .$row['kelas']."</option>";
                ?>  
                <option value="TKJ">TKJ</option>
                <option value="TKR">TKR</option>
                <option value="TITL">TITL </option>
                <option value="TPM">TPM</option>
            </select><br>
            <!-- <label for="tahun">Tahun</label><br>
            <select name="id_spp" id="tahun">

                <?php
                    // $dt_spp = $admin->getDataSPP();
                    // foreach ($dt_spp as $row) :
                ?>

                <option value="<//?= $row['id_spp']; ?>"><//?= $row['tahun']; ?></option>;

                <?php
                    // endforeach;
                ?>

            </select> -->
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>

        <?php
            endforeach;
        }
        ?>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>