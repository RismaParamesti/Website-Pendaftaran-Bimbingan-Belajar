<?php
// Pastikan Anda telah menghubungkan ke database sebelumnya
// Misalnya:
// $koneksi = mysqli_connect("localhost", "root", "", "db_bimbingan");
$koneksi = mysqli_connect("localhost", "root", "", "db_bimbingan");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Periksa apakah parameter id_pendaftar telah diterima
if(isset($_GET['id_pendaftar'])) {
    // Tangkap nilai id_pendaftar dari URL
    $id_pendaftar = $_GET['id_pendaftar'];

    // Query untuk mendapatkan data pendaftar berdasarkan id_pendaftar
    $query = "SELECT * FROM pendaftaran WHERE id_pendaftar = '$id_pendaftar'";
    $result = mysqli_query($koneksi, $query);
if (!$result) {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}


    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Periksa apakah data pendaftar ditemukan
        if(mysqli_num_rows($result) > 0) {
            // Ambil data pendaftar dari hasil query
            $row = mysqli_fetch_assoc($result);

            // Simpan data pendaftar ke dalam variabel
            $nama_lengkap = $row['nama_lengkap'];
            $no_whatsapp = $row['no_whatsapp'];
            $email = $row['email'];
            $asal_sekolah = $row['asal_sekolah'];
            $paket_belajar = $row['paket_belajar'];
        } else {
            // Jika data pendaftar tidak ditemukan, redirect ke halaman utama atau tampilkan pesan kesalahan
            echo "Data pendaftar tidak ditemukan.";
            exit();
        }
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }
} else {
    // Jika parameter id_pendaftar tidak diterima, redirect ke halaman utama atau tampilkan pesan kesalahan
    echo "Parameter id_pendaftar tidak ditemukan.";
    exit();
}

// Proses form update data pendaftar (jika ada)
if(isset($_POST['submit'])) {
    // Tangkap nilai-nilai baru dari form
    $new_nama_lengkap = $_POST['new_nama_lengkap'];
    $new_no_whatsapp = $_POST['new_no_whatsapp'];
    $new_email = $_POST['new_email'];
    $new_asal_sekolah = $_POST['new_asal_sekolah'];
    $new_paket_belajar = $_POST['new_paket_belajar'];

    // Query untuk melakukan update data pendaftar
    $update_query = "UPDATE pendaftaran SET
                     nama_lengkap = '$new_nama_lengkap',
                     no_whatsapp = '$new_no_whatsapp',
                     email = '$new_email',
                     asal_sekolah = '$new_asal_sekolah',
                     paket_belajar = '$new_paket_belajar'
                     WHERE id_pendaftar = '$id_pendaftar'";
    
    // Eksekusi query update
    $update_result = mysqli_query($koneksi, $update_query);

    // Periksa apakah update berhasil
    if($update_result) {
        // Redirect ke halaman laporan.php setelah update berhasil
        header("Location: laporan.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika update gagal
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pendaftar</title>
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
    <h2>Update Data Pendaftar</h2>
    <form action="" method="post">
        <label for="new_nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="new_nama_lengkap" name="new_nama_lengkap" value="<?php echo $nama_lengkap; ?>" required>

        <label for="new_no_whatsapp">Nomor WhatsApp:</label>
        <input type="text" id="new_no_whatsapp" name="new_no_whatsapp" value="<?php echo $no_whatsapp; ?>" required>

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $email; ?>" required>

        <label for="new_asal_sekolah">Asal Sekolah:</label>
        <input type="text" id="new_asal_sekolah" name="new_asal_sekolah" value="<?php echo $asal_sekolah; ?>" required>

        <label for="new_paket_belajar">Pilihan Paket Belajar:</label>
        <select id="new_paket_belajar" name="new_paket_belajar" required>
            <option value="Paket SNBT" <?php if($paket_belajar == "Paket SNBT") echo "selected"; ?>>Paket SNBT</option>
            <option value="Paket Kedinasan" <?php if($paket_belajar == "Paket Kedinasan") echo "selected"; ?>>Paket Kedinasan</option>
            <option value="Paket CPNS" <?php if($paket_belajar == "Paket CPNS") echo "selected"; ?>>Paket CPNS</option>
        </select>

        <button type="submit" name="submit">Update</button>
    </form>
    </div>
</body>
</html>
