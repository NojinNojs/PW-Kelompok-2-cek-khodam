<?php
# Definisikan variabel koneksi database
$servername = "localhost";  # Nama server database (localhost berarti server lokal)
$username = "root";         # Username untuk mengakses database (default root)
$password = "";             # Password untuk username (kosong untuk default)
$dbname = "cek_kodam";      # Nama database yang akan digunakan

# Mulai blok try untuk menangani pengecualian
try {
    # Membuat koneksi ke database menggunakan PDO
    # Format DSN (Data Source Name) adalah "mysql:host=servername;dbname=dbname"
    # $conn adalah objek PDO yang mewakili koneksi ke database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    # Mengatur mode error PDO menjadi exception
    # Ini berarti jika terjadi kesalahan, PDO akan melemparkan objek PDOException
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
# Tangkap pengecualian yang mungkin dilempar oleh blok try
catch(PDOException $e) {
    # Jika terjadi kesalahan, cetak pesan kesalahan
    echo "Connection failed: " . $e->getMessage();
}
?>
