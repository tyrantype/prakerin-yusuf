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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style/style.css">
        <style type="text/css">
            li {margin-right: 10px;}
        </style>
    </head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="?p=transaksi">Transaksi</a>
        <a href="?p=siswa">Data Siswa</a>
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
    
    
