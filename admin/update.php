<?php
// Menyertakan file koneksi database
include '../koneksi.php';

// Proses Update Data Kodam
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitasi input
    $id = htmlspecialchars($_POST['id']);
    $namaKodam = htmlspecialchars($_POST['nama_kodam']);
    $jenisKodam = htmlspecialchars($_POST['jenis_kodam']);

    // Update query menggunakan prepared statement
    // Prepared statement digunakan untuk mencegah SQL Injection dengan memisahkan query dan data
    $stmt = $conn->prepare("UPDATE list_kodam SET nama_kodam = ?, jenis_kodam = ? WHERE id = ?");
    $stmt->bind_param("ssi", $namaKodam, $jenisKodam, $id);
    $stmt->execute();

    // Redirect ke homepage setelah update
    header("Location: homepage.php");
    exit();
}

// Mendapatkan ID dari parameter GET dan mengambil data Kodam
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM list_kodam WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$kodam = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kodam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Update Kodam</h1>

        <!-- Form Update Kodam -->
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= htmlspecialchars($kodam['id']) ?>">
            
            <!-- Input Nama Khodam -->
            <div class="mb-4">
                <label for="nama_kodam" class="block text-sm font-medium text-gray-700 mb-2">Nama Khodam:</label>
                <input type="text" name="nama_kodam" id="nama_kodam" value="<?= htmlspecialchars($kodam['nama_kodam']) ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <!-- Input Jenis Khodam -->
            <div class="mb-6">
                <label for="jenis_kodam" class="block text-sm font-medium text-gray-700 mb-2">Jenis Khodam:</label>
                <input type="text" name="jenis_kodam" id="jenis_kodam" value="<?= htmlspecialchars($kodam['jenis_kodam']) ?>" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-all" required>
            </div>

            <!-- Tombol Update -->
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-all">
                Update
            </button>
        </form>
    </div>

</body>
</html>
