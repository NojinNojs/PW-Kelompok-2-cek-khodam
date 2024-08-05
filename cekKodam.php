<?php
include 'koneksi.php';

/**
 * Fungsi untuk memilih nama dan jenis Kodam secara acak.
 *
 * @param PDO $conn Koneksi database.
 * @return array|null Data Kodam yang dipilih secara acak atau null jika tidak ada data.
 */
function getRandomKodam($conn)
{
    try {
        $sql = "SELECT nama_kodam, jenis_kodam FROM list_kodam";
        $stmt = $conn->query($sql);

        // Fetch all rows as an associative array
        $kodamList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($kodamList) > 0) {
            // Memilih index secara acak
            $randomIndex = mt_rand(0, count($kodamList) - 1);

            // Mengembalikan kodam berdasarkan index acak
            return $kodamList[$randomIndex];
        } else {
            return null;
        }
    } catch (PDOException $e) {
        // Menangani kesalahan koneksi atau query
        return null;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kodam</title> 
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h1>Cek Kodam Kamu!!!</h1>
        <p>Cari tau kodam kamu disini!!!</p>
        <div class="search-container">
            <form action="" method="post">
                <input type="text" name="khodam" placeholder="ex: raffi ..." required pattern="[A-Za-z\s]+" title="Hanya huruf kecil, huruf besar, dan spasi yang diperbolehkan">
                <button type="submit">Cari</button>
            </form>
        </div>

        <?php
        // Memproses data jika formulir disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $error = '';
            if (isset($_POST['khodam'])) {
                $inputName = trim($_POST['khodam']);

                // Validasi input menggunakan regex
                if (empty($inputName)) {
                    $error = "Nama tidak boleh kosong.";
                } elseif (!preg_match("/^[A-Za-z\s]+$/", $inputName)) {
                    $error = "Nama hanya boleh mengandung huruf kecil, huruf besar, dan spasi.";
                } else {
                    // Memanggil fungsi getRandomKodam
                    $kodam = getRandomKodam($conn);
                    if ($kodam) {
                        echo "<h2>Hasil:</h2>";
                        echo "<p><strong>Nama:</strong> $inputName</p>";
                        echo "<p><strong>Kodam:</strong> {$kodam['nama_kodam']}</p>";
                        echo "<p><strong>Jenis Kodam:</strong> {$kodam['jenis_kodam']}</p>";
                    } else {
                        $error = 'Tidak ada data yang ditemukan.';
                    }
                }
            }

            // Tampilkan pesan error jika ada
            if ($error !== '') {
                echo "<div class='alert'>$error</div>";
                echo "<script>
                        document.querySelector('.alert').style.display = 'block';
                      </script>";
            }
        }

        // Menutup koneksi
        $conn = null;
        ?>
    </div>
</body>

</html>
