<?php
session_start();
require_once '../../../config/koneksi.php';

if (isset($_GET['q'])) {
    $response['status'] = null;
    $response['data'] = null;
    $sql = null;

    switch ($_GET['q']) {
        case 'metode-pembayaran':
            $sql = 'SELECT * FROM tb_metode_pembayaran';
            break;
        case 'detail-pembayaran':
            $sql = "SELECT * FROM tb_pembayaran WHERE nisn = '$_GET[nisn]' AND id_spp = '$_GET[id_spp]' AND bln_bayar = '$_GET[bln_bayar]'";
            break;
    }

    $result = $conn->query($sql);
    if ($result) {
        $response['status'] = 'success';
        if ($result->num_rows > 1) {
            foreach ($result as $row) {
                $response['data'][] = $row;
            }
        } else {
            $response['data'] = $result->fetch_assoc();
        }
    } else {
        $response['status'] = 'failed';
    }

    echo json_encode($response);
}
