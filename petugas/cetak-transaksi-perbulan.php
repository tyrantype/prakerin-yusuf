<?php
    session_start();
    require_once 'petugas.php';

    if(!isset($_SESSION['id'])) {
        header('Location: ../');
    }
    $petugas = new Petugas;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Perbulan</title>
    
</head>
<body>
    <h3>Laporan Pembayaran Iuran</h3><br>

    <?php
        $dt1 = $petugas->getDataSiswaByNISN($_GET['nisn']);
        $dt2 = $petugas->getPembayaranById($_GET['id_pembayaran']);
        $dt1_row = mysqli_fetch_assoc($dt1);
    ?>
    <table>
        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><?= $dt1_row['nama_lengkap'];?></td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><?= $dt1_row['nisn'];?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $dt1_row['kelas'];?></td>
        </tr>
    </table>

    <br/>

    <table border="1" cellspacing="" cellpadding="4" width="100%">
        <tr>
            <th>No.</th>
            <th>ID Pembayaran</th>
            <th> Bulan</th>
            <th>Tahun</th>
            <th>Tgl. Bayar</th>
            <th>Nominal</th>
            <th>Keterangan</th>
        </tr>

        <?php
            $dt_pembayaran = $petugas->getPembayaranById($_GET['id_pembayaran']);

            $no = 1;
            while ($dt2_row = mysqli_fetch_assoc($dt2)) :
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $dt2_row['id_pembayaran']; ?></td>
            <td><?= $dt2_row['bln_bayar']; ?></td>
            <td><?= $dt2_row['tahun']; ?></td>
            <td><?= $dt2_row['tgl_bayar']; ?></td>
            <td><?= $dt2_row['nominal']; ?></td>
            <td>Lunas</td>
        </tr>

        <?php endwhile; ?>

    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <br/>
                <p>Jombang, <?= date('d/m/y'); ?><br/>
                    Operator,
                <br/>
                <br/>
                <br/>
                <p>_________________________</p>
            </td>
        </tr>
    </table>
    
    <a href="#" onclick="window.print();"><button>Cetak</button></a>

</body>
</html>