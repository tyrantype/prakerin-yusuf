// menghilangkan modal saat mengklik tombol batal bayar
document.getElementById('batalBayarDialog').addEventListener('click', event => {
    closeModalBayar();
});

// menghilangkan modal saat mengklik area diluar modal content
document.getElementsByClassName('modal-dialog')[0].addEventListener('click', event => {
    if (event.target !== event.currentTarget) return;
    closeModalBayar();
});

// menampilkan preview gambar bukti pembayaran
document.forms['bayarSPPForm']['buktiPembayaran'].addEventListener('change', event => {
    const img = document.getElementById('previewBuktiPembayaran');
    img.src = window.URL.createObjectURL(event.target.files[0]);
    img.style.display = 'grid';
});

function closeModalBayar() {
    document.getElementById('modalBayar').style.display = 'none';
    document.forms['bayarSPPForm'].reset();
    document.getElementById('previewBuktiPembayaran').style.display = 'none';
    document.querySelector('body').style.overflow = 'auto';
}

// mendapatkan list spp via XMLHttpRequest (ajax)
document.addEventListener('DOMContentLoaded', event => {
    getSPP();
    getMetodePembayaran();
});

// update detail spp dan tabel setelah mengubah value select tahun spp
document.getElementById('selectSPP').addEventListener('change', event => {
    updateDetailSPP();
    updateTable();
});

let spp = null;
let currentRow = null;

function getSPP() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'api/get/?q=spp');
    xhr.onload = () => {
        const response = JSON.parse(xhr.responseText);
        spp = response.data;

        // menambahkan option tahun spp menggunakan data yang telah diambil via ajax
        const select = document.getElementById('selectSPP');
        spp.forEach(row => {
            const option = document.createElement('option');
            option.value = row.id_spp;
            option.textContent = row.tahun;
            select.appendChild(option);
        });

        updateDetailSPP();
        updateTable();
    };
    xhr.send();
}

function getMetodePembayaran() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'api/get/?q=metode-pembayaran');
    xhr.onload = () => {
        const response = JSON.parse(xhr.responseText);
        const select = document.forms['bayarSPPForm']['metodePembayaran'];
        response.data.forEach(v => {
            const option = document.createElement('option');
            option.value = v.id;
            option.textContent = v.nama_bank + ' ' + v.nomor + ' A/N ' + v.nama_pemilik_rekening;
            select.appendChild(option);
        });
    };
    xhr.send();
}

function updateDetailSPP() {
    const data = spp[spp.map(v => v.id_spp).indexOf(document.getElementById('selectSPP').value)];
    document.getElementById('tahunSPP').textContent = data.tahun;
    document.getElementById('nominalSPP').textContent = 'Rp ' + new Number(data.nominal).toLocaleString('id-ID');
}

function updateTable() {
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    const tbody = document.getElementById('tableSPP').tBodies[0];
    tbody.innerHTML = '';

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'api/get/?q=pembayaran&id_spp=' + document.getElementById('selectSPP').value);
    xhr.onload = () => {
        const data = JSON.parse(xhr.responseText).data;
        for (i = 0; i < months.length; i++) {
            const tr = document.createElement('tr');
            let td = null;
            let button = null;

            // Kolom nomor
            td = document.createElement('td')
            td.textContent = i + 1;
            tr.appendChild(td);

            // Kolom nama bulan
            td = document.createElement('td')
            td.textContent = months[i];
            tr.appendChild(td);

            if (data !== null) {
                const monthExist = data.map(v => v.bln_bayar).includes(months[i]);
                if (monthExist) {
                    const indexData = data.map(v => v.bln_bayar).indexOf(months[i]);

                    // Kolom tgl_bayar
                    td = document.createElement('td')
                    td.textContent = data[indexData].tgl_bayar !== null ? data[indexData].tgl_bayar : '-';
                    tr.appendChild(td);

                    // Kolom status
                    td = document.createElement('td')
                    td.textContent = data[indexData].status !== null ? data[indexData].status : '-';
                    tr.appendChild(td);

                    // Kolom keterangan
                    td = document.createElement('td')
                    td.textContent = data[indexData].keterangan !== null ? data[indexData].keterangan : '-';
                    tr.appendChild(td);

                    // Kolom aksi
                    if (data[indexData].status === 'success' || data[indexData].keterangan === 'Lunas') {
                        td = document.createElement('td')
                        button = document.createElement('button');
                        button.type = 'button';
                        button.classList.add('btn-cetak');
                        button.textContent = 'Cetak';
                        td.appendChild(button);
                        tr.appendChild(td);
                    } else {
                        td = document.createElement('td')
                        button = document.createElement('button');
                        button.type = 'button';
                        button.classList.add('btn-batal');
                        button.textContent = 'Batal';
                        td.appendChild(button);
                        tr.appendChild(td);
                    }
                } else {
                    // isi kolom sisa dengan "-"
                    for (k = 0; k < 3; k++) {
                        td = document.createElement('td')
                        td.textContent = '-';
                        tr.appendChild(td);
                    }

                    td = document.createElement('td')
                    button = document.createElement('button');
                    button.type = 'button';
                    button.classList.add('btn-bayar');
                    button.textContent = 'Bayar';
                    td.appendChild(button);
                    tr.appendChild(td);
                }
            } else {
                // isi kolom sisa dengan "-"
                for (k = 0; k < 3; k++) {
                    td = document.createElement('td')
                    td.textContent = '-';
                    tr.appendChild(td);
                }

                td = document.createElement('td')
                button = document.createElement('button');
                button.type = 'button';
                button.classList.add('btn-bayar');
                button.textContent = 'Bayar';
                td.appendChild(button);
                tr.appendChild(td);
            }

            tbody.appendChild(tr);
        }

        // add event to button bayar
        Array.from(document.getElementsByClassName('btn-bayar')).forEach(e => {
            e.addEventListener('click', event => {
                document.querySelector('body').style.overflow = 'auto';
                document.getElementById('modalBayar').style.display = 'grid';
                currentRow = event.target.closest('tr').children;
                document.getElementById('bayarSPPBulan').textContent = currentRow.item(1).textContent;
            });
        });

        // add event to button batal
        Array.from(document.getElementsByClassName('btn-batal')).forEach(e => {
            e.addEventListener('click', event => {
                currentRow = event.target.closest('tr').children;
                const idSPP = document.getElementById('selectSPP').value;
                const blnBayar = currentRow.item(1).textContent;
                batalBayar(idSPP, blnBayar);
            });
        });

        // add event to button cetak
        Array.from(document.getElementsByClassName('btn-cetak')).forEach(e => {
            e.addEventListener('click', event => {
                currentRow = event.target.closest('tr').children;
                const idSPP = document.getElementById('selectSPP').value;
                const blnBayar = currentRow.item(1).textContent;
                cetak(idSPP, blnBayar);
            });
        });
    }
    xhr.send();
}

document.forms['bayarSPPForm'].addEventListener('submit', event => {
    event.preventDefault();
    
    const formData = new FormData(document.forms['bayarSPPForm']);
    formData.append('bln_bayar', currentRow.item(1).textContent);
    formData.append('id_spp', document.getElementById('selectSPP').value);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/post/?q=bayar');
    xhr.onload = () => {
        const response = JSON.parse(xhr.responseText);
        if (response.status === 'success') {
            closeModalBayar();
            updateTable();
        }
        alert(response.message);
    };
    xhr.send(formData);
});

function batalBayar(idSPP, blnBayar) {
    if(confirm('Batalkan pembayaran?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', `api/post/?q=batal-bayar&id_spp=${idSPP}&bln_bayar=${blnBayar}`);
        xhr.onload = () => {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                updateTable();
            }
            alert(response.data.message);
        };
        xhr.send();
    }
}

const iframePrint = window.frames['print-area'];

document.getElementById('cetakSemua').addEventListener('click', event => {
    cetak(document.getElementById('selectSPP').value);
});

function cetak(idSPP, blnBayar = null) {
    let url = `pages/cetak.php?id_spp=${idSPP}`;
    if(blnBayar !== null) {
        url += `&bln_bayar=${blnBayar}`;
    }
    iframePrint.src= url;
}