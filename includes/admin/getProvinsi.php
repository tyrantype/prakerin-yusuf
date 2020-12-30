<?php
require_once '../../config/koneksi.php';

$data = array();

$result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.provinsi');
foreach($result as $row) {
    $data[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

echo json_encode($data);