<?php
session_start();
require_once '../../../config/koneksi.php';

if (isset($_GET['q'])) {
    $response['status'] = null;
    $response['data'] = null;
    $sql = null;

    if ($_GET['q'] === 'bayar') {
        require_once 'bayar.php';
    } elseif ($_GET['q'] === 'ubah-password') {
        require_once 'ubah-password.php';
    } elseif ($_GET['q'] === 'batal-bayar') {
        require_once 'batal-bayar.php';
    }

    echo json_encode($response);
}