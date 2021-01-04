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
            <label for="nis">NISN</label><br>
            <input class="inputtext" type="text" name="nisn" id="nisn" required value="<?= $row['nisn']; ?>">
            <br>
            <label for="nis">NIS</label><br>
            <input class="inputtext" type="text" name="nis" id="nis" required value="<?= $row['nis']; ?>">
            <br>
            <label for="nama">Nama Lengkap</label><br>
            <input class="inputtext" type="text" name="nama" id="nama" required value="<?= $row['nama_lengkap']; ?>">
            <br>
            <label for="kelas">Jurusan</label><br>
            <select name="kelas" id="kelas">
                <?php
                    echo "<option value='". $row['kelas'] ."'>" .$row['kelas']."</option>";
                ?>  
                <option value="TKJ">TKJ</option>
                <option value="TKR">TKR</option>
                <option value="TITL">TITL </option>
                <option value="TPM">TPM</option>
            </select><br>

            <label>Tanggal Lahir</label>
            <input type="date" class="inputtext" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" required>

            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="L">L</option>
                <option value="P">P</option>
            </select>

            
            <script>
            let id_desa = <?= $row['id_desa']; ?>;
            let id_kecamatan = <?= $row['id_kecamatan']; ?>;
            let id_kabupaten = <?= $row['id_kabupaten']; ?>;
            let id_provinsi = <?= $row['id_provinsi']; ?>;
            </script>

            <label for="provinsi">Provinsi</label>
            <select name="provinsi" id="provinsi" required>
                <option value="" selected disabled>Pilih provinsi</option>
            </select>

            <label for="kabupaten">Kabupaten</label>
            <select name="kabupaten" id="kabupaten" required>
                <option value="" selected disabled>Pilih kabupaten</option>
            </select>

            <label for="kecamatan">Kecamatan</label>
            <select name="kecamatan" id="kecamatan" required>
                <option value="" selected disabled>Pilih kecamatan</option>
            </select>

            <label for="desa">Desa</label>
            <select name="desa" id="desa" required>
                <option value="" selected disabled>Pilih desa</option>
            </select>

            <label>Nomor HP (Opsional)</label>
            <input type="text" class="inputtext" name="nomor_hp" placeholder="Nomor HP" value="<?= $row['nomor_hp']; ?>">

            <label>Email (Opsional)</label>
            <input type="email" class="inputtext" name="email" placeholder="Email" value="<?= $row['email']; ?>">
            
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>

        <?php
            endforeach;
        }
        ?>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', function(event) {
        fillSelect('provinsi', null, id_provinsi);
    });

    document.getElementById('provinsi').addEventListener('change', function(event) {
        clearSelect('kabupaten');
        clearSelect('kecamatan');
        clearSelect('desa');
        fillSelect('kabupaten', 'provinsi');
    });

    document.getElementById('kabupaten').addEventListener('change', function(event) {
        clearSelect('kecamatan');
        clearSelect('desa');
        fillSelect('kecamatan', 'kabupaten');
    });

    document.getElementById('kecamatan').addEventListener('change', function(event) {
        clearSelect('desa');
        fillSelect('desa', 'kecamatan');
    });

    function clearSelect(id) {
        let select = document.getElementById(id);
        const length = select.options.length;
        for( i = length; i > 0; i--) {
            select.remove(i);
        }
        select.selectedIndex = 0;
    }

    function fillSelect(id, parent = null, value = null) {
        let select = document.getElementById(id);
        let parentSelect = null;
        if(parent !== null) {
            parentSelect = document.getElementById(parent);
            if(parentSelect.selectedIndex === 0) {
                return;
            }
        }

        const ajax = new XMLHttpRequest();
        let url = null;
        if(parent !== null) {
            url = window.location.href.substring(0, window.location.href.lastIndexOf('/')) + `/get${id}.php?id_${parent}=${parentSelect.value}`;
        } else {
            url = window.location.href.substring(0, window.location.href.lastIndexOf('/')) + `/get${id}.php`;
        }
        ajax.open('GET', url);
        ajax.onload = function() {
            try {
                let response = JSON.parse(ajax.responseText);
                if(ajax.status === 200) {
                    for(i = 0; i < response.length; i++) {
                        let option = document.createElement('option');
                        option.value = response[i].id;
                        option.textContent = response[i].nama;
                        select.add(option);
                    }
                    if(value !== null) {
                        select.value = value;
                    }
                    if(id === 'provinsi') {
                        fillSelect('kabupaten', 'provinsi', id_kabupaten);
                    } else if(id === 'kabupaten') {
                        fillSelect('kecamatan', 'kabupaten', id_kecamatan);
                    } else if(id === 'kecamatan') {
                        fillSelect('desa', 'kecamatan', id_desa);
                    }
                }
            } catch(e) {
                console.log(e.message);
                console.log(ajax.responseText);
            }
        }
        ajax.send();
    }
</script>
<?php

    require_once 'footer.php'; 
?>