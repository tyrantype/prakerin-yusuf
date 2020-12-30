<?php
require_once '../../config/koneksi.php';

$data = array();

if(isset($_GET['id_provinsi'])) {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.kabupaten WHERE id_provinsi =' . $_GET["id_provinsi"]);
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_provinsi' => $row['id_provinsi'],
            'nama' => $row['nama']
        );
    }
} else {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.kabupaten');
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_provinsi' => $row['id_provinsi'],
            'nama' => $row['nama']
        );
    }
}

echo json_encode($data);