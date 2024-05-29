<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulir Pendaftaran Bimbingan Belajar Online Gratis siPintar</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #3366FF;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    form {
        margin-top: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }
    input[type="text"],
    input[type="email"],
    select,
    input[type="file"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    button[type="submit"] {
    background-color: #3399FF;
    color: white;
    border: none;
    cursor: pointer;
    padding: 12px 20px; /* Menambahkan padding */
    border-radius: 4px; /* Menambahkan sudut bulat */
    transition: background-color 0.3s; /* Efek transisi saat hover */
    width: 100%; /* Menentukan lebar tombol */
}

button[type="submit"]:hover {
    background-color: #45a049;
}


</style>
</head>
<body>
<div class="container">
    <h2>Formulir Pendaftaran Bimbingan Belajar Online Gratis siPintar</h2>
    <form action="" method="POST"> <!-- Menghapus aksi dan mengosongkan atribut action -->
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" required>

        <label for="no_whatsapp">No. WhatsApp Aktif:</label>
        <input type="text" id="no_whatsapp" name="no_whatsapp" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="asal_sekolah">Asal Sekolah:</label>
        <input type="text" id="asal_sekolah" name="asal_sekolah" required>

        <label for="paket_belajar">Pilihan Paket Belajar:</label>
        <select id="paket_belajar" name="paket_belajar" required>
            <option value="Paket SNBT">Paket SNBT</option>
            <option value="Paket Kedinasan">Paket Kedinasan</option>
            <option value="Paket CPNS">Paket CPNS</option>
        </select>

        <button type="submit" name="submit" >Daftar</button>
        <button onclick="window.location.href='laporan.php'" style="width: 100%; padding: 10px; margin-top: 10px; background-color: red; color: white;">Lihat Laporan Pendaftar</button>

    </form>
</div>
</body>
</html>


<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bimbingan");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Mengambil nilai dari formulir
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_whatsapp = $_POST['no_whatsapp'];
    $email = $_POST['email'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $paket_belajar = $_POST['paket_belajar'];

    // Query untuk menyimpan data pendaftaran ke database
    $query = "INSERT INTO pendaftaran (nama_lengkap, no_whatsapp, email, asal_sekolah, paket_belajar) 
              VALUES ('$nama_lengkap', '$no_whatsapp', '$email', '$asal_sekolah','$paket_belajar')";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah data berhasil disimpan
    if ($result) {
        echo "<div style='text-align:center;'>Pendaftaran berhasil!</div>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>
