<?php
require_once '../../config/koneksi.php';

$data = null;

if(isset($_GET['new_nisn']) && isset($_GET['new_nis']) && isset($_GET['nisn']) && isset($_GET['nis'])) {
    $result = mysqli_query($db->konek, 'SELECT COUNT(*) totalRows FROM tb_siswa WHERE (nisn =' . $_GET["nisn"] . ' OR nis=' . $_GET['nis'] . ') AND (NOT ' . 'nisn=' . $_GET['new_nisn'] . ' OR NOT nis=' . $_GET['new_nis'] . ')');
    foreach($result as $row) {
        $data = array(
            'totalRows' => (int) $row['totalRows']
        );
    }
}

echo json_encode($data);