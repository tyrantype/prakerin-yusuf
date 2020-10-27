
<?php
    if(isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $uname = $_POST['username'];
        $pass = sha1($_POST['password']);
        $level = $_POST['level'];

        if($admin->tambahDataPetugas($nama, $uname, $pass, $level)) {
            $_SESSION['pesan'] = "Tambah data petugas berhasil";
            header('Location: ?p=petugas');
        } else {
            $_SESSION['pesan'] = "Tambah data petugas gagal";
        }
    }
?>

<h2>Tambah Petugas</h2>

<div id="kontainer-konten">
    <div class="kontainerform">
        <form method="POST">
            <label>Nama Lengkap</label><br/>
            <input class="inputtext" type="text" name="nama" placeholder="Masukkan Nama" required><br/>
            
            <label for="username">Username</label><br/>
            <input class="inputtext" id="username" type="text" name="username" placeholder="Masukkan Username" required><br/>
            
            <label>Password</label><br/>
            <input class="inputpassword" class="pass" type="password" name="password" placeholder="Masukkan Password" required><br/>
            
            <label>Level</label><br/>
            <select name="level">
                <option value="Admin">Admin</option>
                <option value="Petugas">Petugas</option>
            </select>
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>

