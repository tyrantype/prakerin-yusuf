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
        <title>Halaman Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../style/style.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <style type="text/css">
            li {margin-right: 10px;}
        </style>
    </head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="?p=beranda">Beranda</a>
        <a href="?p=siswa">Data Siswa</a>
        <a href="?p=petugas">Data Petugas</a>
        <a href="?p=spp">Data SPP</a></li>
        <a href="?p=laporan">Laporan</a> 
        <!-- <a href="?p=generate">Generate Data Siswa</a>  -->
        <a id="logout" href="?p=logout">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <div>☰</div>
        </a>
    </nav>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>