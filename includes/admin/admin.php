<?php
    require_once '../../config/koneksi.php';

    class Admin extends Koneksi {
        public function getDataPetugas($id) {
            $stmt = mysqli_query($this->konek, "SELECT nama_petugas, username, level FROM tb_petugas WHERE id_petugas = '" . $id . "'");

            return $stmt;
        }
        public function getAllDataPetugas() {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_petugas");

            return $stmt;
        }
        public function tambahDataPetugas($nama, $username, $password, $level) {
            $stmt = mysqli_query($this->konek, "INSERT INTO tb_petugas VALUES ('', '$username', '$password', '$nama','$level')");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function ubahDataPetugas($nama, $username, $password, $level, $id) {
            $stmt = mysqli_query($this->konek, "UPDATE tb_petugas SET nama_petugas = '$nama', username = '$username', password = '$password', level = '$level' WHERE id_petugas = '$id'");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function hapusDataPetugas($id) {
            $stmt = mysqli_query($this->konek, "DELETE FROM tb_petugas WHERE id_petugas = '$id'");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }


        // CRUD SPP
        public function getDataSPP() {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_spp ORDER BY tahun ASC");

            return $stmt;
        }
        public function tambahDataSPP($tahun, $nominal) {
            $stmt = mysqli_query($this->konek, "INSERT INTO tb_spp VALUES ('', '" . $tahun . "', '" . $nominal . "')");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function getDataSPPbyId($id) {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_spp WHERE id_spp = '".$id."'");

            return $stmt;
        }
        public function ubahDataSPP($tahun, $nominal, $id) {
            $stmt = mysqli_query($this->konek, "UPDATE tb_spp SET tahun ='".$tahun ."', nominal = '".$nominal."' WHERE id_spp = ".$id);

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function hapusDataSPP($id){
            $stmt = mysqli_query($this->konek, "DELETE FROM tb_spp WHERE id_spp = ".$id);

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }


        //Ambil Data Siswa dari database
        public function getDataSiswa() {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_siswa ORDER BY nisn ASC");
            return $stmt;
        }
        //Validasi Data Siswa
        public function cekDataSiswa($nisn, $nis) {
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_siswa WHERE nisn = '$nisn' or nis = '$nis'");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        //tambah Data Siswa
        public function tambahDataSiswa($nisn, $nis, $nama, $kelas) {
            $stmt = mysqli_query($this->konek, "INSERT INTO tb_siswa VALUES ('$nisn','$nis','$nama','$kelas')");

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function tambahDataSiswaByArray($siswa) {
            $sql = "INSERT INTO tb_siswa VALUES ('" . $siswa['nisn'] . "','" . $siswa['nis'] . "','" . $siswa['nama_lengkap'] . "','" . $siswa['kelas'] . "')";
            $stmt = mysqli_query($this->konek, $sql);

            if($stmt) {
                return true;
            } else {
                return false; 
            }
        }
        public function getDataSiswaByNisn($nisn){
            $stmt = mysqli_query($this->konek, "SELECT * FROM tb_siswa WHERE nisn = '$nisn'");

            return $stmt;
        }
        //ubah Data Siswa
        public function ubahDataSiswa($nis, $nama, $kelas, $nisn) {
            $stmt = mysqli_query($this->konek, "UPDATE tb_siswa SET nis ='$nis', nama_lengkap = '$nama', kelas = '$kelas' WHERE nisn = '$nisn'");
            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        //Hapus Data Siswa
        public function hapusDataSiswa($nisn){
            $stmt = mysqli_query($this->konek, "DELETE FROM tb_siswa WHERE nisn = ".$nisn);

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }

        public function hapusDataPembayaran($nisn){
            $stmt = mysqli_query($this->konek, "DELETE FROM tb_pembayaran WHERE nisn = ".$nisn);

            if($stmt) {
                return true;
            } else {
                return false;
            }
        }
        public function getDataPembayaranPerPeriode($date1, $date2) {
            $stmt = mysqli_query($this->konek, "SELECT p.id_pembayaran, p.nisn, w.nama_lengkap, p.tgl_bayar, p.bln_bayar, s.tahun, s.nominal, t.nama_petugas FROM tb_pembayaran p
            INNER JOIN tb_siswa w ON w.nisn = p.nisn
            INNER JOIN tb_spp s ON s.id_spp = p.id_spp
            INNER JOIN tb_petugas t ON t.id_petugas = p.id_petugas
            WHERE p.tgl_bayar BETWEEN '$date1' and '$date2'
            ORDER BY p.id_pembayaran");
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
