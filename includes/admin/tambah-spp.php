<?php
    if(isset($_POST['submit'])) {
        $simpan = $admin->tambahDataSPP($_POST['tahun'], $_POST['nominal']);
        var_dump($simpan);

        if($simpan) {
            header('Location: ?p=spp');
            $_SESSION['pesan'] = "Data SPP berhasil ditambah";
        } else {
            header('Location: ?p=spp');
            $_SESSION['pesan'] = "Data SPP gagal ditambah";
        }
    }
?>

<h2>Tambah data SPP</h2>
<div id="kontainer-konten">
    <div class="kontainerform">
        <form method="post">
            <label for="tahun">Tahun</label><br>
            <input class="inputtext" type="text" name="tahun" id="tahun" placeholder="Masukan tahun ajaran" required><br>
            
            <label for="nominal">Nominal</label><br>
            <input class="inputtext"t ype="text" name="nominal" id="nominal" placeholder="Masukan nominal" required><br>
            
            <input class="inputsubmit" class="tambahdata" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</div>
<?php

    require_once 'footer.php'; 
?>