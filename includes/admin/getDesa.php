<?php
require_once '../../config/koneksi.php';

$data = array();

if(isset($_GET['id_kecamatan'])) {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.desa WHERE id_kecamatan =' . $_GET["id_kecamatan"]);
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_kecamatan' => $row['id_kecamatan'],
            'nama' => $row['nama']
        );
    }
} else {
    $result = mysqli_query($db->konek, 'SELECT * FROM wilayah_administratif_indonesia.desa');
    foreach($result as $row) {
        $data[] = array(
            'id' => $row['id'],
            'id_kecamatan' => $row['id_kecamatan'],
            'nama' => $row['nama']
        );
    }
}

echo json_encode($data);