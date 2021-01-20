<?php
require_once 'upload-image.php';

$conn->begin_transaction();

$sql = "INSERT INTO tb_pembayaran (
    nisn, 
    bln_bayar, 
    id_spp, 
    id_metode_pembayaran,
    nama_pengirim,
    nama_bank_pengirim
) 
VALUES (
    '$_SESSION[nisn]',
    '$_POST[bln_bayar]',
    '$_POST[id_spp]',
    '$_POST[id_metode_pembayaran]',
    '$_POST[nama_pengirim]',
    '$_POST[nama_bank_pengirim]'
);";

if ($conn->query($sql)) {
    $statusUpload = uploadImage($conn->insert_id);
    
    $response['status'] = $statusUpload['status'];
    if ($response['status'] === 'success') {
        $conn->commit();
        $response['message'] = 'Berhasil melakukan pembayaran';
    } else {
        $conn->rollback();
        $response['message'] = $statusUpload['message'];
    }
} else {
    $response['status'] = 'failed';
}