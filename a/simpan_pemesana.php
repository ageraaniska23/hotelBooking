<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $nama = $_POST["nama"];                     // Mendapatkan nilai nama dari formulir
    $jenisKelamin = $_POST["jenisKelamin"];     // Mendapatkan nilai jenis kelamin dari formulir
    $nomorIdentitas = $_POST["nomorIdentitas"]; // Mendapatkan nilai nomor identitas dari formulir
    $tipeKamar = $_POST["tipeKamar"];           // Mendapatkan nilai tipe kamar dari formulir
    $tanggalPesan = $_POST["tanggalPesan"];     // Mendapatkan nilai tanggal pemesanan dari formulir
    $durasiMenginap = $_POST["durasiMenginap"]; // Mendapatkan nilai durasi menginap dari formulir
    $termasukBreakfast = isset($_POST["termasukBreakfast"]) ? 1 : 0; // Mendapatkan nilai termasuk sarapan (jika dicentang) dari formulir
    $totalBayar = $_POST["totalBayar"];         // Mendapatkan nilai total bayar dari formulir

    // Establish a database connection
    $conn = new mysqli('localhost', 'root', '', 'datasave'); // Membuat koneksi ke database MySQL

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error); // Menghentikan eksekusi jika koneksi ke database gagal
    }

    // Prepare and execute the SQL statement to insert data into the 'data' table
    $stmt = $conn->prepare("INSERT INTO data (nama, jenisKelamin, nomorIdentitas, tipeKamar, tanggalPesan, durasiMenginap, termasukBreakfast, totalBayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sssssssi", $nama, $jenisKelamin, $nomorIdentitas, $tipeKamar, $tanggalPesan, $durasiMenginap, $termasukBreakfast, $totalBayar);

        if ($stmt->execute()) {
            echo '<script>alert("Pesanan Selesai");</script>'; // Menampilkan pesan sukses jika data berhasil disimpan ke database
        } else {
            echo "Error: " . $stmt->error; // Menampilkan pesan error jika terjadi kesalahan saat mengeksekusi pernyataan SQL
        }

        $stmt->close(); // Menutup pernyataan SQL
    } else {
        echo "Error: " . $conn->error; // Menampilkan pesan error jika terjadi kesalahan saat menyiapkan pernyataan SQL
    }

    // Close the database connection
    $conn->close(); // Menutup koneksi ke database
} else {
    echo "Invalid request method."; // Menampilkan pesan jika metode permintaan tidak valid (harus POST)
}
?>
