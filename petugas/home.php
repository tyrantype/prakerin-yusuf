
<!-- v1

<div id="kontainer-konten">

    <div id="konten">
        <h1>Selamat Datang,</h1>
        <h1 class="username"><//?= $_SESSION['namapetugas'] ?></h1>
    </div>
</div> -->



<!-- v2 -->
<div id="kontainer-konten">

    <div id="konten">
        <h1>Selamat Datang</h1>
        <h3 style="text-align: center;"><?= $row['nama_petugas']; ?></h3>
    </div>
</div>