<?php
session_start();
require_once '../../../config/koneksi.php';

if (isset($_GET['q'])) {
    $response['status'] = null;
    $response['data'] = null;
    $sql = null;

    switch ($_GET['q']) {
        case 'spp':
            $sql = 'SELECT * FROM tb_spp';
            break;
        case 'pembayaran':
            $sql = "SELECT * FROM tb_pembayaran WHERE nisn = $_SESSION[nisn] AND id_spp=$_GET[id_spp]";
            break;
        case 'metode-pembayaran':
            $sql = "SELECT * FROM tb_metode_pembayaran WHERE nama_bank <> 'Tunai'";
            break;
        case 'profile':
            $sql = "
            SELECT 
                tb_siswa.nama_lengkap 'Nama Lengkap', 
                tb_siswa.nisn 'NISN', tb_siswa.nis 'NIS', 
                tb_siswa.kelas 'Kelas', 
                tb_siswa.tanggal_lahir 'Tanggal Lahir', 
                tb_siswa.nomor_hp 'Nomor HP', 
                tb_siswa.email 'Email', 
                desa.nama 'Desa', 
                kecamatan.nama 'Kecamatan', 
                kabupaten.nama 'Kabupaten', 
                provinsi.nama 'Provinsi' 
            FROM tb_siswa 
            JOIN wilayah_administratif_indonesia.desa 
                ON desa.id = tb_siswa.id_desa
            JOIN wilayah_administratif_indonesia.kecamatan 
                ON kecamatan.id = desa.id_kecamatan
            JOIN wilayah_administratif_indonesia.kabupaten 
                ON kabupaten.id = kecamatan.id_kabupaten
            JOIN wilayah_administratif_indonesia.provinsi 
                ON provinsi.id = kabupaten.id_provinsi WHERE tb_siswa.nisn = $_SESSION[nisn]";
            break;
        case 'laporan-pembayaran':
            $sql = "
                SELECT 
                    tb_siswa.nama_lengkap, 
                    tb_siswa.kelas, 
                    tb_siswa.nisn,
                    tb_pembayaran.id_pembayaran, 
                    tb_pembayaran.bln_bayar, 
                    tb_spp.tahun, 
                    tb_pembayaran.tgl_bayar, 
                    tb_spp.nominal, 
                    tb_pembayaran.keterangan
                FROM tb_pembayaran
                JOIN tb_siswa
                    ON tb_siswa.nisn = tb_pembayaran.nisn
                JOIN tb_spp
                    ON tb_spp.id_spp = tb_pembayaran.id_spp
                WHERE 
                    tb_siswa.nisn = '$_SESSION[nisn]'
            ";
            if (isset($_GET['id_spp'])) {
                $sql .= "
                    AND
                        tb_pembayaran.id_spp = '$_GET[id_spp]'
                ";

                if (isset($_GET['bln_bayar'])) {
                    $sql .= "
                        AND
                            tb_pembayaran.bln_bayar = '$_GET[bln_bayar]'
                    ";
                }
            }
            break;
    }

    $result = $conn->query($sql);
    if ($result) {
        $response['status'] = 'success';
        foreach ($result as $row) {
            $response['data'][] = $row;
        }
    } else {
        $response['status'] = 'failed';
    }

    echo json_encode($response);
}
