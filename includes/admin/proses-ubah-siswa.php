<?php
session_start();

require_once 'admin.php';
$admin = new Admin;

$response['status'] = null;

if($admin->ubahDataSiswa($_POST['nisn'], $_POST['nis'], $_POST['nama'], $_POST['kelas'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'], $_POST['nomor_hp'], $_POST['email'], $_POST['desa']))
{
    $response['status'] = 'sukses';
    $_SESSION['pesan'] = "Data Siswa berhasil diubah";
} else {
    $response['status'] = 'gagal';
}


echo json_encode($response);
