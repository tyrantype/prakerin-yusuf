<?php 
session_start();
if (!isset($_SESSION['nisn'])) {
    header('Location: ../');
}
if ($_SESSION['level'] !== 'siswa') {
    header('Location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="assets/scripts/index.js" defer></script>
</head>

<body>
    <nav class="topnav" id="myTopnav">
        <a href="?p=spp">SPP</a>
        <a href="?p=profile">Profile</a>
        <a id="logout" href="?p=logout">Logout</a>
        <a class="icon">☰</a>
    </nav>
    
    <?php
    if (isset($_GET['p'])) {
        if ($_GET['p'] === 'spp') {
            require_once 'pages/spp.php';
        } elseif ($_GET['p'] === 'profile') {
            require_once 'pages/profile.php';
        } elseif ($_GET['p'] === 'logout') {
            session_destroy();
            header('Location: ../');
        }
    } else {
        require_once 'pages/dashboard.php';
    }
    ?>
</body>

</html>