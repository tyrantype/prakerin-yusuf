<?php
require_once 'upload-image.php';

$conn->begin_transaction();

$sql = "
INSERT INTO tb_pembayaran (
    nisn, 
    id_spp,
    bln_bayar, 
    id_petugas,
    id_metode_pembayaran,
    nama_pengirim,
    nama_bank_pengirim,
    status,
    keterangan
) 
VALUES (
    '$_POST[nisn]',
    '$_POST[id_spp]',
    '$_POST[bln_bayar]',
    '$_SESSION[id]',
    '$_POST[id_metode_pembayaran]',
    '$_POST[nama_pengirim]',
    '$_POST[nama_bank_pengirim]',
    '$_POST[status]',
    '$_POST[keterangan]'
)
";


if ($conn->query($sql)) {
    if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
        $statusUpload = uploadImage($conn->insert_id);

        if ($statusUpload['status'] === 'success') {
            $conn->commit();
            $response['status'] = $statusUpload['status'];
            $response['data'] = array(
                'message' => 'Berhasil melakukan pembayaran'
            );
        } else {
            $conn->rollback();
            $response['status'] = 'failed';
            $response['data']  = array(
                'message' => $statusUpload['message']
            );
        }
    } else {
        $conn->commit();
        $response['status'] = 'success';
        $response['data'] = array(
            'message' => 'Berhasil melakukan pembayaran'
        );
    }
} else {
    $response['status'] = 'failed';
    $response['data'] = array(
        'message' => 'Kesalahan eksekusi query'
    );
    $conn->rollback();
}