<?php
// Check if the id_pendaftar parameter is set
if (isset($_GET['id_pendaftar'])) {
    // Get the id_pendaftar value from the GET request
    $id_pendaftar = $_GET['id_pendaftar'];

    // Connect to the database
    $koneksi = mysqli_connect("localhost", "root", "", "db_bimbingan");

    // Check the database connection
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal: " . mysqli_connect_error();
        exit();
    }

    // Query to delete data from the database
    $query = "DELETE FROM pendaftaran WHERE id_pendaftar = '$id_pendaftar'";
    
    // Execute the query
    $result = mysqli_query($koneksi, $query);

    // Check if the query was successful
    if ($result) {
        // Return a success message
        echo "Data berhasil dihapus";
    } else {
        // Return an error message
        echo "Error saat menghapus data: " . mysqli_error($koneksi);
    }

    // Close the database connection
    mysqli_close($koneksi);
} else {
    // If id_pendaftar parameter is not set, return an error message
    echo "Parameter id_pendaftar tidak ditemukan";
}
?>
