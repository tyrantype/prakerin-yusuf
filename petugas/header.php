<!-- </?php
        session_start();
        require_once 'petugas.php';

        $petugas = new Petugas;

        //Kembali ke halaman login
        if(!isset($_SESSION['id'])) {
            header ('Location: ../../');
        }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Halaman Petugas</title>
            <link rel="stylesheet" href="../style/style.css">
            <style type="text/css">
                    li {margin-right: 10px;}
            </style>
        </head>
    <body>
        <div>
            <div class="navbar" id="navbar">
                <li><b>Aplikasi Pembayaran SPP</b></li>
                <a href="?p=transaksi">Transaksi</a>
                <a id="logout" href="?p=logout">Logout</a>
            </div>
        </div>
        </?php
            // date_default_timezone_set("Asia/Jakarta");
            // $currentDateTime = date('Y-m-d H:i:s');
            // echo $currentDateTime;

            //tes waktu
        ?>
 -->


<?php
    session_start();
    require_once 'petugas.php';

    $petugas = new Petugas;

    //Kembali ke halaman login
    if(!isset($_SESSION['id'])) {
        header ('Location: ../../');
    }

    $rows = $petugas->getAccountNameById($_SESSION['id']);
    $row = mysqli_fetch_assoc($rows);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Petugas</title>
        <link rel="stylesheet" href="../style/style.css">
        <style type="text/css">
                li {margin-right: 10px;}
        </style>
    </head>
<body>
    <div>
        <div class="navbar" id="navbar">
            <!-- <li><b>Aplikasi Pembayaran SPP</b></li> -->
            <a href="?p=transaksi">Transaksi</a>
            <a href="?p=siswa">Data Siswa</a>
            <a id="logout" href="?p=logout">Logout</a>
        </div>
    </div>
    
