<?php
include '../koneksi.php'; // Menyertakan koneksi database

// Mengambil ID dari query string
$id = $_GET['id'];

// Query delete dengan prepared statement
$sql = "DELETE FROM list_kodam WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // Menggunakan bind_param untuk mencegah SQL Injection
$stmt->execute();

// Redirect kembali ke homepage setelah delete
header("Location: homepage.php");
exit();
?>
