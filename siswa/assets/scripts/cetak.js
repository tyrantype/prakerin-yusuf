document.addEventListener('DOMContentLoaded', event => {
    const urlParams = new URLSearchParams(window.location.search);
    const blnBayar = urlParams.get('bln_bayar');
    const idSPP = urlParams.get('id_spp');

    let apiURL = '../api/get/?q=laporan-pembayaran';
    if(idSPP !== null) {
        apiURL += '&id_spp=' + idSPP;
        if(blnBayar !== null) {
            apiURL += '&bln_bayar=' + blnBayar;
        }
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', apiURL);
    xhr.onload = () => {
        const response = JSON.parse(xhr.responseText);
        if(response.data === null) {
            alert('Belum melakukan pembayaran pada tahun terpilih');
        } else {
            if (response.status === 'success' && response.data.length > 0) {
                document.getElementById('nama-lengkap').textContent = response.data[0].nama_lengkap;
                document.getElementById('kelas').textContent = response.data[0].kelas;
                document.getElementById('nisn').textContent = response.data[0].nisn;
    
                const tbody = document.querySelector('#table-pembayaran tbody');
                let num = 0;
                response.data.forEach(v => {
                    let tr = document.createElement('tr');
                    let td = null;
    
                    td = document.createElement('td');
                    td.textContent = ++num;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.id_pembayaran;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.bln_bayar;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.tahun;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.tgl_bayar;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.nominal;
                    tr.appendChild(td);
    
                    td = document.createElement('td');
                    td.textContent = v.keterangan;
                    tr.appendChild(td);
    
                    tbody.appendChild(tr);
                });
                document.getElementById('tanggal-cetak').textContent = new Date().toISOString().split('T')[0];
                
                window.print();
            }
        }
    };
    xhr.send();
});