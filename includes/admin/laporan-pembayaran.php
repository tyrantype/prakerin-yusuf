
<h2>Laporan Pembayaran</h2>

<div id="kontainer-konten" style="margin-bottom: 0; min-height: 0;">
    <div id="scrolltable-wrap" >
        <div style="display: inline-block;">
            <form method="POST">
                <label>Tampilkan data dari tgl.</label> 
                <input class="inputdate" type="date" value="<?= date('Y-m-01') ?>" name="tgl_awal">
                <label>sampai tgl.</label>
                <input class="inputdate" type="date" value="<?= date('Y-m-t') ?>" name="tgl_akhir">
                <button class="tombolbiru" type="submit" name="tampil" value="Tampilkan">Tampilkan</button>
            </form>
        </div>
        <div style="display: inline-block;">
            <button class="inputsubmit" id="convert" onclick="convert()">Convert ke Excel</button>
        </div>
        <br/><br/>
        <div id="scrolltable" style="">        
            <!-- Table menampilkan Data Transaksi -->
            <?php
                $total_pembayaran = 0;
                if (isset($_POST['tampil'])) {
                    $date1 = $_POST['tgl_awal'];
                    $date2 = $_POST['tgl_akhir'];
                    $data = $admin->getTotalPembayaran($date1, $date2);
                    foreach ($data as $row) :
                    $total_pembayaran = $row['total_pembayaran'];
                    endforeach;
                }
            ?>
            <p>Jumlah Pemasukan : <span id="total-pembayaran"><?= $total_pembayaran ?></span></p>
            <table class="divTableLaporan" id="table_content">
                <tr class="divTableRowHead">
                    <th class="divTableHead">No.</th>
                    <th class="divTableHead">ID Transaksi</th>
                    <th class="divTableHead">NISN</th>
                    <th class="divTableHead">Nama Lengkap</th>
                    <th class="divTableHead">Tgl. Bayar</th>
                    <th class="divTableHead">Bulan Bayar</th>
                    <th class="divTableHead">Tahun</th>
                    <th class="divTableHead">Nominal</th>
                    <th class="divTableHead">Nama Petugas</th>
                </tr>

                <?php
                    if (isset($_POST['tampil'])) {
                    $date1 = $_POST['tgl_awal'];
                    $date2 = $_POST['tgl_akhir'];

                    $data = $admin->getDataPembayaranPerPeriode($date1, $date2); // akan muncul error karena belum dibuat

                    $no = 1;
                    $total = 0;
                    foreach ($data as $r):
                ?>

                <tr class="divTableRow">
                    <td class="divTableCell"><?= $no++ ?></td>
                    <td class="divTableCell"><?= $r['id_pembayaran'] ?></td>
                    <td class="divTableCell"><?= $r['nisn'] ?></td>
                    <td class="divTableCell"><?= $r['nama_lengkap'] ?></td>
                    <td class="divTableCell"><?= $r['tgl_bayar'] ?></td>
                    <td class="divTableCell"><?= $r['bln_bayar'] ?></td>
                    <td class="divTableCell"><?= $r['tahun'] ?></td>
                    <td class="divTableCell"><?= $r['nominal'] ?></td>
                    <td class="divTableCell"><?= $r['nama_petugas'] ?></td>
                </tr>

                <?php
                    $total += $r['nominal'];
                    endforeach;

                    } else {echo "
                        <tr >
                            <td class='divTableHead' style='background-color: white;' colspan='10'><center>Tidak ada Data Transaksi</center>
                            </td>
                        </tr>";
                }
                ?>
            
            </table>
        </div>
    </div>
</div>

<div style="background-color: white;">
    <style>
        #container {
            height: 400px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }
    </style>

    <div>
        <p><strong>Chart</strong></p>
        <label for="id-spp">Pilih tahun</label>
        <select id="id-spp"></select>
    </div>

    <figure class="highcharts-figure">
        <div id="container-nomor"></div>
    </figure>

    <figure class="highcharts-figure">
        <div id="container-uang"></div>
    </figure>

    <script src="libraries/highcharts/highcharts.js"></script>
    <script src="libraries/highcharts/modules/data.js"></script>
    <script src="libraries/highcharts/modules/exporting.js"></script>
    <script src="libraries/highcharts/modules/accessibility.js"></script>
    <script defer>
        let dataChart = [];
        let chartNomor = null;
        let chartUang = null;

        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('id-spp').addEventListener('change', (event) => {
                drawChart('nomor');
                drawChart('uang');
            });

            getSPP();
        });

        function getSPP() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'api/get/?q=spp');
            xhr.onload = () => {
                const select = document.getElementById('id-spp');
                const response = JSON.parse(xhr.responseText);
                response.data.forEach(v => {
                    let option = document.createElement('option');
                    option.value = v.id_spp;
                    option.textContent = v.tahun;
                    select.appendChild(option);
                });
                drawChart('nomor');
                drawChart('uang');
            };
            xhr.send();
        }

        

        function drawChart(type) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `api/get/?q=chart&type=${type}&id_spp=` + document.getElementById('id-spp').value);
            xhr.onload = () => {
                const response = JSON.parse(xhr.responseText);
                let tkj = {
                    name: 'TKJ',
                    data: response.data.map(v => Number(v.TKJ))
                };

                let tkr = {
                    name: 'TKR',
                    data: response.data.map(v => Number(v.TKR))
                };

                let titl = {
                    name: 'TITL',
                    data: response.data.map(v => Number(v.TITL))
                };

                let tpm = {
                    name: 'TPM',
                    data: response.data.map(v => Number(v.TPM))
                };

                dataChart = [tkj, tkr, titl, tpm];
                
                let chart = type === 'nomor' ? chartNomor : chartUang;
                let chartTitle = type === 'nomor' ? 'Jumlah Transaksi' : 'Jumlah Pemasukan'
                if(chartNomor === null) {
                    chart = Highcharts.chart(type === 'nomor' ? 'container-nomor' : 'container-uang', {
                        series: dataChart,
                        xAxis: {
                            labels: {
                                formatter() {
                                return response.data[this.pos].bulan.substring(0, 3);
                                }
                            }
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: `${chartTitle} SPP Tahun ` + document.getElementById('id-spp').options[document.getElementById('id-spp').selectedIndex].textContent + ' Berdasarkan Jurusan'
                        },
                        yAxis: {
                            allowDecimals: false,
                            title: {
                                text: chartTitle
                            }
                        },
                    });
                } else {
                    for(i = 0; i < dataChart.length; i++) {
                        chart.series[i].update({
                            data: dataChart[i].data
                        }, true);
                    }
                    chart.setTitle({
                        text: 'Data Pembayaran SPP Tahun ' + document.getElementById('id-spp').options[document.getElementById('id-spp').selectedIndex].textContent + ' Berdasarkan Jurusan'
                    });
                }
            };
            xhr.send();
        }
    </script>
</div>

<?php
    require_once 'footer.php'; 
?>

<!-- Library javascript export table data ke file Excel, pengganti PHPCOmposer -->
<script src="xlsx.full.min.js"></script>
<script src="filesaver.min.js"></script>
<script type="text/javascript">
    var wb = XLSX.utils.table_to_book(document.getElementById('table_content'), {raw: true});
    var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});
    function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
    }
    function convert(){
        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'admin-laporan-pembayaran.xlsx');
    }
</script>