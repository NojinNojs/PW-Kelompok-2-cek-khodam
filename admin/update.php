<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_kodam = $_POST['nama_kodam'];
    $jenis_kodam = $_POST['jenis_kodam'];

    $sql = "UPDATE list_kodam SET nama_kodam = ?, jenis_kodam = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nama_kodam, $jenis_kodam, $id]); // Fix variable name here
    header("Location: homepage.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM list_kodam WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$kodam = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Kodam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update Kodam</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= isset($kodam['id']) ? htmlspecialchars($kodam['id']) : '' ?>">
        <label for="nama_kodam">Nama Khodam:</label>
        <input type="text" name="nama_kodam" id="nama_kodam" value="<?= isset($kodam['nama_kodam']) ? htmlspecialchars($kodam['nama_kodam']) : '' ?>" required>
        <label for="jenis_kodam">Jenis Khodam:</label>
        <input type="text" name="jenis_kodam" id="jenis_kodam" value="<?= isset($kodam['jenis_kodam']) ? htmlspecialchars($kodam['jenis_kodam']) : '' ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
