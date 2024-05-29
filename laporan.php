<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #3366FF;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .table-container {
            max-width: 800px; 
            margin: 0 auto; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid black;
            text-transform: none;
        }

        th {
            background-color: white;
            color: black;
            text-transform: none;
        }

        tr:nth-child(even) {
            background-color: white; 
        }

        tr:hover {
            background-color: grey; 
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            background-color: yellow;
            color: black;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button a:hover {
            background-color: green;
            color: #fff;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            border-bottom: none; /* Remove the bottom border */
        }

        .action-buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .action-buttons button.update {
            background-color: green; /* Green */
            color: white;
        }

        .action-buttons button.delete {
            background-color: red; /* Red */
            color: white;
        }

        .action-buttons button:hover {
            filter: brightness(90%); /* Reduce brightness on hover */
        }
        td:last-child {
            border-bottom: none; /* Remove the bottom border */
        }
    </style>
</head>
<body>
    
    <h1>Laporan Pendaftar Bimbingan Online Gratis siPintar</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Nomor WhatsApp</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Paket Belajar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data dari database akan dimasukkan ke sini -->
                <?php
                    // Menghubungkan ke database
                    $koneksi = mysqli_connect("localhost", "root", "", "db_bimbingan");

                    // Periksa koneksi
                    if (mysqli_connect_errno()) {
                        echo "Koneksi database gagal: " . mysqli_connect_error();
                        exit();
                    }

                    // Query untuk mengambil data
                    $query = "SELECT * FROM pendaftaran";
                    $result = mysqli_query($koneksi, $query);

                    // Periksa apakah query berhasil dieksekusi
                    if (!$result) {
                        echo "Error saat menjalankan query: " . mysqli_error($koneksi);
                        exit();
                    }

                    // Tampilkan data dalam tabel
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['nama_lengkap'] . "</td>";
                            echo "<td>" . $row['no_whatsapp'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['asal_sekolah'] . "</td>";
                            echo "<td>" . $row['paket_belajar'] . "</td>";
                            echo "<td class='action-buttons'>
                            <button class='update' onclick=\"window.location.href='update.php?id_pendaftar=" . $row['id_pendaftar'] . "'\">Update</button>
        
                            <button class='delete' onclick=\"deleteData(" . $row['id_pendaftar'] . ")\">Delete</button>
                          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                    }

                    // Tutup koneksi
                    mysqli_close($koneksi);
                ?>

            </tbody>
        </table>
    </div>
    <div class="back-button">
        <a href="index.php">Form Pendaftaran</a>
    </div>
    <script>
        function deleteData(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Tampilkan pesan sukses atau error
                        alert(this.responseText);
                        // Reload halaman setelah data dihapus
                        window.location.reload();
                    }
                };
                xhttp.open("GET", "delete.php?id_pendaftar=" + id, true);
                xhttp.send();
            }
        }
    </script>

</body>
</html>
