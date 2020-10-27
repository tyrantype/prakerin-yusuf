<?php
    if(!session_id()) session_start();
    require_once 'proses.php';

    $proses = new Proses;

    if(isset($_SESSION['id'])) {
        if($_SESSION['level'] == "Admin") {
            header('Location: includes/admin/?p=beranda');
            } else {
                header('Location: petugas/?p=home');
        }
    }

    if (isset($_POST['masuk'])) {
        $username = $proses->konek->real_escape_string($_POST['username']);
        $password = $proses->konek->real_escape_string(sha1 ($_POST['password']));
        
        $masuk = $proses->loginPetugas($username, $password);

        if($masuk->num_rows > 0) {
            $data = mysqli_fetch_assoc($masuk);

            if($data['level'] == "Admin") {  
                header('Location: includes/admin/?p=beranda');
                $_SESSION['id'] = $data['id_petugas'];
                $_SESSION['namapetugas'] = $data['nama_petugas'];
                $_SESSION['level'] = $data['level'];
            } else {
                header('Location: petugas/?p=home');
                $_SESSION['id'] = $data['id_petugas'];
                $_SESSION['namapetugas'] = $data['nama_petugas'];
                $_SESSION['level'] = $data['level'];
            }
        } else {
            $_SESSION['error'] = "Username atau password tidak valid";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style/style2.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login</title>
    </head>

    <div class="login">
        <div class="main">
        <img class="sign" src="style/logo_10nopember.png">
            <p class="sign" align="center">Pembayaran SPP</p>
            
            
            <div>
                <?php
                    if (isset($_SESSION['error'])) {
                        echo '<span style="color:red;">' . $_SESSION['error'] . '</span>';
                    }
                ?>
            </div>
            <form method="post" action="" autocomplete="off" class="form1">
                <label for="username"></label>
                <input class="un " name="username" id="username" type="text" align="center" placeholder="Username">
                <label for="password"></label>
                <input class="pass"  name="password" id="username" type="password" align="center" placeholder="Password">
                <input type="submit" class="submit" name="masuk" value="Masuk" align="center">
            </form>
        </div>
     </div>
</html>

