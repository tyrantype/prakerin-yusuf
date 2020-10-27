<?php
session_start();
    require_once 'admin.php';

    $admin = new Admin;

    //Kembali ke halaman login
    if(!isset($_SESSION['id'])) {
        header ('Location: ../../');
    }

    $id = $_SESSION['id'];

    $data = $admin->getDataPetugas($id);
    $row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style/style.css">
        <title>Halaman Admin</title>
        <style type="text/css">
            li {margin-right: 10px;}
        </style>
    </head>
<body>

        <div class="navbar" id="navbar">
            <a href="?p=beranda">Beranda</a>
            <a href="?p=siswa">Data Siswa</a>
            <a href="?p=petugas">Data Petugas</a>
            <a href="?p=spp">Data SPP</a></li>
            <a href="?p=laporan">Laporan</a> 
            <!-- <a href="?p=generate">Generate Data Siswa</a>  -->
            <a id="logout" href="?p=logout">Logout</a>
        </div>