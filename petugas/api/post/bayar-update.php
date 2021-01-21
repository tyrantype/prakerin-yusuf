<?php
require_once 'upload-image.php';

$conn->begin_transaction();


$sql = "
    UPDATE tb_pembayaran
    SET
        tgl_bayar = '$_POST[tgl_bayar],
        id_petugas = '$_SESSION[id]',
        id_metode_pembayaran = '$_POST[id_metode_pembayaran]',
        nama_pengirim = '$_POST[nama_pengirim]',
        nama_bank_pengirim = '$_POST[nama_bank_pengirim]',
        status = '$_POST[status]',
        keterangan = '$_POST[keterangan]'
    WHERE
        nisn =  '$_POST[nisn]' AND
        id_spp = '$_POST[id_spp]' AND
        bln_bayar = '$_POST[bln_bayar]'
";


if ($conn->query($sql)) {
    if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
        $sql = "
            SELECT id_pembayaran
            FROM tb_pembayaran
            WHERE
                nisn =  '$_POST[nisn]' AND
                id_spp = '$_POST[id_spp]' AND
                bln_bayar = '$_POST[bln_bayar]'
        ";
        $result = $conn->query($sql);

        if($result) {
            $statusUpload = uploadImage($result->fetch_assoc()['id_pembayaran']);

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
            $conn->rollback();
            $response['status'] = 'failed';
            $response['data']  = array(
                'message' => 'Kesalahan eksekusi query'
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