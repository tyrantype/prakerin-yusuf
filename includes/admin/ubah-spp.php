<?php
    require_once 'header.php';
?>
<?php

    if(isset($_POST['submit'])) {
        if($admin->ubahDataSPP($_POST['tahun'], $_POST['nominal'], $_GET['id']))
        {
            header('Location: ?p=spp');
            $_SESSION['pesan'] = "Data SPP berhasil diubah";
        } else {
            header('Location: ?p=spp');
            $_SESSION['pesan'] = "Data SPP gagal diubah";
        }
    }

    if(isset($_GET['id'])) {
    $dt_spp = $admin->getDataSPPbyId($_GET['id']);

    foreach ($dt_spp as $row) :
?>

<h2>Ubah data SPP</h2>
<div id="kontainer-konten">
    <div class="kontainerform">
        <form method="post">
            <label for="tahun">Tahun</label><br>
            <input class="inputtext" type="text" name="tahun" id="tahun" placeholder="Masukan tahun ajaran" required value="<?= $row['tahun']; ?>"><br>

            <label for="nominal">Nominal</label><br>
            <input class="inputtext" type="text" name="nominal" id="nominal" placeholder="Masukan nominal" required value="<?= $row['nominal']; ?>">
            <br>
            <input class="inputsubmit" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</div>
<?php
    endforeach;
}
?>
<?php

require_once 'footer.php'; 
?>