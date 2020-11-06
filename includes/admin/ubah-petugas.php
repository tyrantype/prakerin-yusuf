<?php
    if(isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $uname = $_POST['username'];
        $pass = sha1($_POST['password']);
        $level = $_POST['level'];
        $id = $_GET['id'];

        if($admin->ubahDataPetugas($nama, $uname, $pass, $level, $id)) {
            $_SESSION['pesan'] = "Ubah data petugas berhasil";
            header('Location: ?p=petugas');
        } else {
            $_SESSION['pesan'] = "Ubah data petugas gagal";
            header('Location: ?p=petugas');
        }
    }

    $data = $admin->getDataPetugas($_GET['id']);

    foreach ($data as $row) :
?>

<h2>Ubah Data Petugas</h2>

<div id="kontainer-konten">
    <div class="kontainerform">
        <form method="POST">
            <label>Nama Lengkap</label><br/>
            <input class="inputtext" type="text" name="nama" required value="<?= $row['nama_petugas']; ?>"><br/>            
            <label>Username</label><br/>
            <input class="inputtext" type="text" name="username" required value="<?= $row['username']; ?>"><br/>            
            <label>Password</label><br/>
            <input class="inputpassword" type="password" name="password" required value=""><br/>
            <label>Level</label><br/>
            <select name="level">
                <?php
                    echo "<option value='". $row['level'] ."'>" .$row['level']."</option>";
                ?>  
                <option value="Admin">Admin</option>
                <option value="Petugas">Petugas</option>
            </select> 
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>

        <?php
            endforeach;
        ?>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>