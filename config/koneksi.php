<?php
    class Koneksi {
        var $host = 'localhost';
        var $user = 'root';
        var $pass = '';
        var $db_name = 'spp-pi-revisi'; // nama database

        public function __construct() {
            $this->konek = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
            
            if($this->konek){
                // echo "Koneksi Sukses";
            }else{
                echo "Koneksi Gagal";
            }
        }
    }
    $db = new Koneksi();