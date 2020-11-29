
<!-- v2 -->
<?php
    require_once '../config/koneksi.php';

    class Petugas extends Koneksi {
        public function getDataSPP() {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_spp ORDER BY tahun ASC");

            return $stmt;
        }

        public function getDataSPPbyId($id_spp) {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_spp WHERE id_spp=$id_spp");

            return $stmt;
        }

        public function getDataSiswaByNISN($nisn) {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_siswa WHERE nisn = '$nisn'");

            return $stmt;
        }

        public function getDataPembayaran($nisn, $id_spp) {
            $stmt = mysqli_query($this->konek, "SELECT p.bln_bayar, p.id_pembayaran, p.tgl_bayar, pt.nama_petugas FROM tb_pembayaran AS p INNER JOIN tb_spp AS s ON p.id_spp = s.id_spp INNER JOIN tb_petugas AS pt ON p.id_petugas = pt.id_petugas WHERE p.nisn = '$nisn' AND p.id_spp= $id_spp");
            return $stmt;
        }

        public function prosesBayar($nisn,  $tgl_bayar, $id_spp, $nmr_bln, $id_petugas) {
            $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $bln_bayar = $bulan[$nmr_bln];
            $stmt = mysqli_query($this->konek, "INSERT INTO tb_pembayaran(nisn, tgl_bayar, bln_bayar, id_spp, id_petugas) VALUES($nisn, '$tgl_bayar', '$bln_bayar', $id_spp, $id_petugas)");
            return $stmt;
        }

        public function batalBayar($id_pembayaran) {
            $stmt = mysqli_query($this->konek, "DELETE FROM tb_pembayaran WHERE id_pembayaran=$id_pembayaran");

            return $stmt;
        }

        public function getPembayaranById($id) {
            $stmt = mysqli_query($this->konek, "SELECT p.id_pembayaran, p.bln_bayar, s.tahun, s.nominal, p.tgl_bayar, pt.nama_petugas FROM tb_pembayaran AS p INNER JOIN tb_spp AS s ON p.id_spp = s.id_spp LEFT JOIN tb_petugas AS pt ON p.id_petugas = pt.id_petugas WHERE p.id_pembayaran = '$id' ORDER BY p.id_pembayaran ASC");

            return $stmt;
        }

        public function getAccountNameById($id) {
            $stmt = mysqli_query($this->konek, "SELECT nama_petugas FROM tb_petugas WHERE id_petugas='$id'");
            return $stmt;
        }

        public function getNumberOfAllRecords() {
            $stmt = mysqli_query($this->konek, "SELECT COUNT(*) FROM tb_siswa");
            return $stmt;
        }

        public function getSiswaDataNth($page) {
            $start = ($page * 10) - 9;
            $stmt = mysqli_query($this->konek, "SELECT * FROM (SELECT ROW_NUMBER() OVER (ORDER BY nisn) row_num, nisn, nis, nama_lengkap, kelas FROM tb_siswa) tb_siswa_ordered WHERE row_num >= $start LIMIT 10");
            return $stmt;
        }

        public function getDataSiswaByNISNAndName($values1) {
            $values2 = explode(" ", $values1);
            $sql = "SELECT * FROM tb_siswa WHERE ";
            $len = count($values2);
            $i = 0;
            foreach($values2 as $value) :
                if($i < $len - 1) {
                    $sql = $sql . "nisn LIKE '%$value%' OR nama_lengkap LIKE '%$value%' OR ";
                } else {
                    $sql = $sql . "nisn LIKE '%$value%' OR nama_lengkap LIKE '%$value%'";
                }
                $i++;
            endforeach;
            $stmt = mysqli_query($this->konek, $sql);
            return $stmt;
        }
    }
