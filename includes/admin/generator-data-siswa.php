<div style="display: grid; place-items: center; text-align: center;  margin-top: 50px;">
<form method="POST" action="" style="">
    <label for="jumlah">Jumlah generate data (Max 50): </label><br>
    <input type="number"  min="1" max="50" name="jumlah" id="jumlah" required><br>
    <input type="submit" name="submit" value="Generate"><br><br>
</form>

<?php
    require_once 'randomNameGenerator.php';
    $rng = new randomNameGenerator;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['jumlah'] <= 50 ) {
        $arrayOfSiswa = null;
        $jumlah = $_POST['jumlah'];
        $kelas = array('X', 'XI', 'XII');
        $names = $rng->generateNames($jumlah);

        for($i = 0; $i < $jumlah; $i++) {
            $arrayOfSiswa[] = array(
                'nisn' => rand(200000, 299999),
                'nis' => rand(2000, 2999),
                'nama_lengkap' => $names[$i],
                'kelas' => $kelas[rand(0, count($kelas) -1)]
            );
        }

        echo "<table style=\"border: 1px solid black;\">";
            echo "<tr>";
                echo "<td>No</td>";
                echo "<td>NISN</td>";
                echo "<td>NIS</td>";
                echo "<td>Nama</td>";
                echo "<td>Kelas</td>";
            echo "</tr>";
                $i = 0;
                foreach($arrayOfSiswa as $siswa) :
                    echo "<tr>";
                    if($admin->tambahDataSiswaByArray($siswa)) {
                        echo "<td>".++$i."</td>";
                        echo "<td>".$siswa['nisn']."</td>";
                        echo "<td>".$siswa['nis']."</td>";
                        echo "<td>".$siswa['nama_lengkap']."</td>";
                        echo "<td>".$siswa['kelas']."</td>";
                    } else {
                        echo "<td colspan=\"3\">Gagal menambahkan data siswa</td>";
                        break;
                    }
                    echo "</tr>";
                endforeach;
        echo "</table>";
        
        
    }
        
?>
</div>
