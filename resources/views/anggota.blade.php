<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Data Anggota</title>
</head>
<body>

    <h2>Daftar Anggota</h2>
    <button onclick="loadData()">Refresh Data</button>
    <p id="status"></p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="tabelBody"></tbody>
    </table>

    <script>
const API_URL = "http://127.0.0.1:8000/api/anggota";
        function loadData() {
            const status = document.getElementById("status");
            status.innerText = "Memuat data...";

            fetch(API_URL)
                .then(res => {
                    if (!res.ok) throw new Error("Gagal terhubung ke API (Status: " + res.status + ")");
                    return res.json();
                })
                .then(data => {
                    console.log("Data diterima:", data);
                    
                    // Laravel terkadang membungkus array dalam object 'data'
                    const list = Array.isArray(data) ? data : data.data;

                    if (!list || list.length === 0) {
                        status.innerText = "Database kosong.";
                        document.getElementById("tabelBody").innerHTML = "";
                        return;
                    }

                    let html = "";
                    list.forEach(item => {
                        html += `<tr>
                            <td>${item.id}</td>
                            <td>${item.nama}</td>
                            <td>${item.kelas}</td>
                            <td>${item.email}</td>
                        </tr>`;
                    });

                    document.getElementById("tabelBody").innerHTML = html;
                    status.innerText = "Berhasil memuat " + list.length + " anggota.";
                })
                .catch(err => {
                    console.error("Error:", err);
                    status.innerText = "Error: " + err.message + ". Pastikan Laravel sudah jalan (php artisan serve).";
                });
        }

        // Jalankan saat halaman dibuka
        loadData();
    </script>
</body>
</html>