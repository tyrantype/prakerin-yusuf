
<?php
if (isset($_POST['submit'])) {
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_hp = $_POST['nomor_hp'];
    $email = $_POST['email'];
    $id_desa = $_POST['desa'];
    

    $cek = $admin->cekDataSiswa($nisn, $nis);

    if($cek->num_rows > 0)
    {
        header('Location: ?p=siswa');
        $_SESSION['pesan'] = "NISN atau NIS sudah terdaftar";
    }
    else
    {
        if($admin->tambahDataSiswa($nisn, $nis, $nama, $kelas, $tanggal_lahir, $jenis_kelamin, $nomor_hp, $email, $id_desa))
        {
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

            <label>Tanggal Lahir</label>
            <input type="date" class="inputtext" name="tanggal_lahir" required>

            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="L">L</option>
                <option value="P">P</option>
            </select>

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
            <input type="text" class="inputtext" name="nomor_hp" placeholder="Nomor HP">

            <label>Email (Opsional)</label>
            <input type="email" class="inputtext" name="email" placeholder="Email">

            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', function(event) {
        fillSelect('provinsi');
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

    function fillSelect(id, parent = null) {
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
