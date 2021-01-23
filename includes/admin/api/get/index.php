<?php
session_start();
require_once '../../../../config/koneksi.php';

if (isset($_GET['q'])) {
    $response['status'] = null;
    $response['data'] = null;
    $sql = null;

    switch ($_GET['q']) {
        case 'spp' : 
            $sql = "SELECT * FROM tb_spp";
            break;
        case 'chart':
            if($_GET['type'] === 'nomor') {
                $sql = "
                SELECT
                    'Januari' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Februari' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Maret' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'April' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Mei' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Juni' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Juli' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Agustus' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'September' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Oktober' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'November' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Desember' bulan,
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT COUNT(*) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn 
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                ";
            } elseif($_GET['type'] === 'uang') {
                $sql = "
                SELECT
                    'Januari' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Januari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Februari' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Februari' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Maret' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Maret' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'April' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'April' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Mei' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Mei' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Juni' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juni' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Juli' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Juli' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Agustus' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Agustus' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'September' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'September' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Oktober' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Oktober' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'November' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'November' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                UNION
                SELECT
                    'Desember' bulan,
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKJ'
                    ) 'TKJ',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TKR'
                    ) 'TKR',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_pembayaran.status = 'success'
                        AND tb_siswa.kelas = 'TITL'
                    ) 'TITL',
                    (
                        SELECT SUM(tb_spp.nominal) 
                        FROM tb_pembayaran 
                        JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn JOIN tb_spp ON tb_spp.id_spp = tb_pembayaran.id_spp
                        WHERE tb_pembayaran.id_spp = $_GET[id_spp]  
                        AND tb_pembayaran.status = 'success'
                        AND tb_pembayaran.bln_bayar = 'Desember' 
                        AND tb_siswa.kelas = 'TPM'
                    ) 'TPM'
                ";
            }
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
