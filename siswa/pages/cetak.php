<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/cetak.css">
    <script src="../assets/scripts/cetak.js" defer></script>
</head>

<body>
    <div id="print-container">
        <h3>Laporan Pembayaran</h3>
        <table id="table-siswa">
            <tbody>
                <tr>
                    <th>Nama Siswa</th>
                    <td>:</td>
                    <td>
                        <span id="nama-lengkap"></span>
                    </td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>:</td>
                    <td>
                        <span id="kelas"></span>
                    </td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>:</td>
                    <td>
                        <span id="nisn"></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>

        <table id="table-pembayaran">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Pembayaran</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Tgl. Bayar</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <br>

        <div id="ttd">
            <p>Jombang, <span id="tanggal-cetak"></span></p>
            <p>Admin,</p>
            <br><br><br>
            <p>_________________________</p>
        </div>
    </div>
</body>

</html>