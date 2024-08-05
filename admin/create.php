<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_khodam = $_POST['nama_kodam'];
    $jenis_khodam = $_POST['jenis_kodam'];

    $sql = "INSERT INTO list_kodam (nama_kodam, jenis_kodam) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nama_khodam, $jenis_khodam]);
    header("Location: homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Create Kodam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create New Kodam</h1>
    <form method="post" action="">
        <label for="nama_kodam">Nama Khodam:</label>
        <input type="text" name="nama_kodam" id="nama_kodam" required>
        <label for="jenis_kodam">Jenis Khodam:</label>
        <input type="text" name="jenis_kodam" id="jenis_kodam" required>
        <button type="submit">Create</button>
    </form>
</body>
</html>
