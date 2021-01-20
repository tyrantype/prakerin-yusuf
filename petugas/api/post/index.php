<?php
session_start();
require_once '../../../config/koneksi.php';

if (isset($_GET['q'])) {
    $response['status'] = null;
    $response['data'] = null;
    $sql = null;

    if ($_GET['q'] === 'bayar-insert') {
        require_once 'bayar-insert.php';
    } elseif ($_GET['q'] === 'bayar-update') {
        require_once 'bayar-update.php';
    }

    echo json_encode($response);
}