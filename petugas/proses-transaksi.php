<?php
    session_start();
    require_once 'petugas.php';
    date_default_timezone_set("Asia/Jakarta");

    $petugas = new Petugas;

    if(!isset($_SESSION['id'])) {
        header('Location: ../');
    } else {
        if($_GET['act'] == 'bayar') {
            // ambil id_pembayaran dari url
            $nisn = $_GET['nisn'];
            // tanggal bayar (hari ini)
            $tgl_bayar = date('Y-m-d');
            // id_petugas yang saat ini login
            $id_petugas = $_SESSION['id'];
            $id_spp = $_GET['id_spp'];
            $nmr_bln = $_GET['nmr_bln'];
            $bayar = $petugas->prosesBayar($nisn,  $tgl_bayar, $id_spp, $nmr_bln, $id_petugas);

            if($bayar) {
                $_SESSION['pesan'] = ', Pembayaran Sukses';
                header('Location: index.php?nisn='.$_SESSION['nisn'].'&id_spp='.$_SESSION['id_spp']);
            } else {
                $_SESSION['pesan'] = ', Pembayaran Gagal';
                header('Location: index.php?nisn='.$_SESSION['nisn'].'&id_spp='.$_SESSION['id_spp']);
            }
            
        } elseif($_GET['act'] == 'batal') {
            $id_pembayaran = $_GET['id_pembayaran'];
            $batal = $petugas->batalBayar($id_pembayaran);

            if($batal) {
                $_SESSION['pesan'] = ', Pembayaran Dibatalkan';
                header('Location: index.php?nisn='.$_SESSION['nisn'].'&id_spp='.$_SESSION['id_spp']);
            } else {
                $_SESSION['pesan'] = ', Pembatalan gagal';
                header('Location: index.php?nisn='.$_SESSION['nisn'].'&id_spp='.$_SESSION['id_spp']);
            }
        }
    }
        

