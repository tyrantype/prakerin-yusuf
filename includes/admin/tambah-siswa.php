
<?php
if (isset($_POST['submit'])) {
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    // $id_spp = $_POST['id_spp'];

    $cek = $admin->cekDataSiswa($nisn, $nis);

    if($cek->num_rows > 0)
    {
        header('Location: ?p=siswa');
        $_SESSION['pesan'] = "NISN atau NIS sudah terdaftar";
    }
    else
    {
        if($admin->tambahDataSiswa($nisn, $nis, $nama, $kelas))
        {
            // $bulan[] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            // for ($i=0; $i < 12; $i++) { 
            // $admin->tambahDataPembayaran($nisn, $bulan[0][$i], $id_spp);
            // }
            header('Location: ?p=siswa');
            $_SESSION['pesan'] = "Data Siswa berhasil ditambah";
        }
        else
        {
            header('Location: ?p=siswa');
            $_SESSION['pesan'] = "Data Siswa gagal ditambah";
        }
    }
}
?>
<h2>Tambah Data Siswa</h2>

<div id="kontainer-konten">
    <div class="kontainerform">
        <form align="center" method="post">
            <label for="nisn">NISN</label>
            <input class="inputtext" type="text" name="nisn" id="nisn" placeholder="Masukkan NISN" required>
            <div>
                <label for="nis">NIS</label>
                <input class="inputtext" type="text" name="nis" id="nis" placeholder="Masukkan NIS" required>
            </div>

            <label for="nama">Nama Lengkap</label>
            <input class="inputtext" type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required><br>
           
            <label for="kelas">Jurusan</label>
            <select name="kelas" id="kelas">
                <option value="TKJ">TKJ</option>
                <option value="TKR">TKR</option>
                <option value="TITL">TITL </option>
                <option value="TPM">TPM</option>
            </select>
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
            <br>
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>
