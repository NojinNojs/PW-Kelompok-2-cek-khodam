<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kodam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            width: 300px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            font-weight: bold;
            text-align: center;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Data Kodam</h1>
        <form method="post" action="">
            <input type="text" name="nama_kodam" placeholder="Nama Kodam" required>
            <input type="text" name="jenis_kodam" placeholder="Jenis Kodam" required>
            <button type="submit" name="submit">Tambah</button>
        </form>
        <?php
        //cek jika tombol tambah ditekan
        if (isset($_POST['submit'])) {
            include 'koneksi.php';
            //tampung setiap inputan ke variabel
            $nama_kodam = trim($_POST['nama_kodam']);
            $jenis_kodam = trim($_POST['jenis_kodam']);
            // cek untuk memastikan inputan yg diterima tidak kosong
            if (!empty($nama_kodam) && !empty($jenis_kodam)) {
                // query sql insert ke db dengan data dinamis
                $sql = "INSERT INTO list_kodam (nama_kodam, jenis_kodam) VALUES
('$nama_kodam', '$jenis_kodam')";
                if ($conn->query($sql) === TRUE) {
                    echo '<p class="message success">Data berhasil
ditambahkan!</p>';
                } else {
                    echo '<p class="message error">Terjadi kesalahan: ' .
                        $conn->error . '</p>';
                }
                $conn->close();
            } else {
                echo '<p class="message error">Error: Semua field harus
diisi.</p>';
            }
        }
        ?>
    </div>
</body>

</html>