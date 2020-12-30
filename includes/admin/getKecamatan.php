<?php
require_once '../../config/koneksi.php';

$data = array();

if(isset($_GET['id_kabupaten'])) {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.kecamatan WHERE id_kabupaten =' . $_GET["id_kabupaten"]);
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_kabupaten' => $row['id_kabupaten'],
            'nama' => $row['nama']
        );
    }
} else {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.kecamatan');
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_kabupaten' => $row['id_kabupaten'],
            'nama' => $row['nama']
        );
    }
}

echo json_encode($data);