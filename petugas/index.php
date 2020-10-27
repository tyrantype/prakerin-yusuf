
<?php
    require_once 'header.php';  
    if(isset($_GET['p'])) {
        if($_GET['p'] == 'transaksi') {
            require_once 'includes/transaksi.php';
        }
            elseif($_GET['p'] == 'home') {
            require_once 'home.php';
        }   
            elseif($_GET['p'] == 'siswa') {
            require_once 'data-siswa.php';
        }   
            elseif($_GET['p'] == 'logout') {
            header('Location: ../');
            session_destroy();
        }
    } elseif(isset($_GET['nisn']) ) {
        require_once 'includes/transaksi.php';
        $_SESSION['nisn'] = $_GET['nisn'];
        $_SESSION['id_spp'] = $_GET['id_spp'];
    }
    
    // require_once 'footer.php';
?>

