const table = document.getElementById('profile');
const xhr = new XMLHttpRequest();

xhr.open('GET', 'api/get/?q=profile');
xhr.onload = () => {
    const data = JSON.parse(xhr.responseText).data[0];
    for (key in data) {
        const tr = document.createElement('tr');

        const th = document.createElement('th');
        th.textContent = key;
        tr.appendChild(th);

        const td = document.createElement('td');
        td.textContent = data[key];
        tr.appendChild(td);

        table.appendChild(tr);
    }
};
xhr.send();

document.forms['ubahPassword'].addEventListener('submit', event => {
    event.preventDefault();

    const passwordLama = document.forms['ubahPassword']['passwordLama'];
    const passwordBaru = document.forms['ubahPassword']['passwordBaru'].value;
    const passwordBaru2 = document.forms['ubahPassword']['passwordBaru2'].value;

    if(passwordBaru === passwordBaru2) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData(document.forms['ubahPassword']);
        xhr.open('POST','api/post/?q=ubah-password');
        xhr.onload = () => {
            const response = JSON.parse(xhr.responseText);
            if(response.status === 'success') {
                alert(response.data.message);
                document.forms['ubahPassword'].reset();
            } else {
                alert(response.data.message);
            }
        };
        xhr.send(formData);
    } else {
        alert('Password tidak sama');
    }
});