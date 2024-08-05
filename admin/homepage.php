<?php
include '../koneksi.php'; // Menyertakan file koneksi database

// Mengambil data dari tabel list_kodam
$sql = "SELECT * FROM list_kodam";
$stmt = $conn->query($sql);
$kodamList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Menyimpan semua hasil query dalam bentuk array asosiatif
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Read Kodam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Kodam List</h1>
    <a href="create.php">Create New Kodam</a> <!-- Link untuk membuat Kodam baru -->
    <table>
        <tr>
            <th>No</th>
            <th>Nama Khodam</th>
            <th>Jenis Khodam</th>
            <th>Actions</th>
        </tr>
        <?php 
        $counter = 1; // Menginisialisasi counter untuk nomor urut
        foreach ($kodamList as $kodam): ?> <!-- Melakukan loop untuk setiap item di $kodamList -->
        <tr>
            <td><?php echo $counter; ?></td> <!-- Menampilkan nomor urut -->
            <td><?php echo htmlspecialchars($kodam['nama_kodam']); ?></td> <!-- Menampilkan nama khodam dengan fungsi htmlspecialchars untuk menghindari XSS -->
            <td><?php echo htmlspecialchars($kodam['jenis_kodam']); ?></td> <!-- Menampilkan jenis khodam dengan fungsi htmlspecialchars -->
            <td>
                <a href="update.php?id=<?php echo urlencode($kodam['id']); ?>">Update</a> <!-- Link untuk update, menggunakan id sebagai parameter -->
                <a href="delete.php?id=<?php echo urlencode($kodam['id']); ?>">Delete</a> <!-- Link untuk delete, menggunakan id sebagai parameter -->
            </td>
        </tr>
        <?php 
        $counter++; // Meningkatkan counter untuk nomor urut
        endforeach; ?> <!-- Mengakhiri loop -->
    </table>
</body>
</html>
