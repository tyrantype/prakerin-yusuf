<?php
$passwordLama = sha1($_POST['passwordLama']);
$passwordBaru = sha1($_POST['passwordBaru']);
$passwordBaru2 = sha1($_POST['passwordBaru2']);

$sql = "SELECT COUNT(*) total FROM tb_siswa WHERE nisn = $_SESSION[nisn] AND password = '$passwordLama'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    if (intval($row['total']) === 0) {
        $response['status'] = 'failed';
        $response['data'] = array(
            'message' => 'Password lama salah'
        );
    } else {
        if ($passwordBaru !== $passwordBaru2) {
            $response['status'] = 'failed';
            $response['data'] = array(
                'message' => 'Password baru tidak sama'
            );
        } else {
            $sql = "UPDATE tb_siswa SET password = '$passwordBaru' WHERE nisn = $_SESSION[nisn]";
            if (!$conn->query($sql)) {
                $response['status'] = 'failed';
                $response['data'] = array(
                    'message' => 'Terjadi kesalahan eksekusi kueri'
                );
            } else {
                $response['status'] = 'success';
                $response['data'] = array(
                    'message' => 'Berhasil mengubah password'
                );
            }
        }
    }
} else {
    $response['status'] = 'failed';
    $response['data'] = array(
        'message' => 'Terjadi kesalahan eksekusi kueri'
    );
}
