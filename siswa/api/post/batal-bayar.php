<?php
$conn->begin_transaction();
$sql = "SELECT id_pembayaran, status FROM tb_pembayaran WHERE nisn = '$_SESSION[nisn]' AND bln_bayar = '$_GET[bln_bayar]' AND id_spp = '$_GET[id_spp]'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    if($row['status'] === 'success') {
        $response['status'] = 'failed';
        $response['data'] = array(
            'message' => 'Tidak bisa menghapus pembayaran karena sudah terverifikasi'
        );
    } else {
        $id_pembayaran = $row['id_pembayaran'];
        if ($conn->query("START TRANSACTION")) {
            $sql = "DELETE FROM tb_pembayaran WHERE id_pembayaran = $id_pembayaran; ";
            if ($conn->query($sql)) {
                $file_image = glob("../../assets/images/bukti-pembayaran/$id_pembayaran.*");

                if (unlink($file_image[0])) {
                    $conn->commit();
                    $response['status'] = 'success';
                    $response['data'] = array(
                        'message' => 'Berhasil membatalkan pembayaran'
                    );
                } else {
                    $conn->rollback();
                    $response['status'] = 'failed';
                    $response['data'] = array(
                        'message' => 'Tidak bisa menghapus gambar'
                    );
                }
            } else {
                $response['status'] = 'failed';
                $response['data'] = array(
                    'message' => "Kesalahan eksekusi query 2 $sql"
                );
            }
        } else {
            $response['status'] = 'failed';
            $response['data'] = array(
                'message' => 'Kesalahan eksekusi query transaction'
            );
        }
    }
} else {
    $response['status'] = 'failed';
    $response['data'] = array(
        'message' => 'Kesalahan eksekusi query 1'
    );
}