<!DOCTYPE html>
<!-- Deklarasi tipe dokumen untuk HTML5 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Menentukan set karakter yang digunakan adalah UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mengatur viewport untuk responsive design -->
    <title>Kalkulator Sederhana</title>
    <!-- Judul halaman yang muncul di tab browser -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.0/modern-normalize.min.css">
    <!-- Menggunakan normalize.css untuk konsistensi tampilan di berbagai browser -->
    <style>
        /* Styling dasar untuk tampilan halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        /* Styling untuk container kalkulator */
        .calculator {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin-bottom: 20px;
        }

        .calculator h1 {
            margin-bottom: 20px;
        }

        /* Styling untuk input angka */
        input[type="number"] {
            width: 40%;
            padding: 10px;
            margin: 5px;
            font-size: 1.2em;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        /* Styling untuk tombol operasi */
        .operations button {
            padding: 10px 20px;
            margin: 10px 5px;
            font-size: 1.2em;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .operations button:hover {
            background-color: #555;
        }

        /* Styling untuk area hasil */
        .result {
            margin-top: 20px;
            font-size: 1.2em;
            color: #000;
        }

        /* Styling untuk team card */
        .team {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 150px;
        }

        .card img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 10px 0 5px 0;
            font-size: 1em;
        }

        .card p {
            font-size: 0.9em;
            color: #777;
        }

        .contributor {
            color: green;
            font-weight: bold;
        }

        .non-contributor {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="calculator">
        <h1>Kalkulator Sederhana</h1>
        <input type="number" id="num1" placeholder="Angka 1">
        <!-- Input untuk angka pertama -->
        <input type="number" id="num2" placeholder="Angka 2">
        <!-- Input untuk angka kedua -->
        <div class="operations">
            <button onclick="calculate('subtract')">-</button>
            <!-- Tombol untuk operasi pengurangan -->
            <button onclick="calculate('divide')">/</button>
            <!-- Tombol untuk operasi pembagian -->
        </div>
        <div class="result" id="result">Hasil: </div>
        <!-- Area untuk menampilkan hasil perhitungan -->
    </div>

    <!-- Bagian untuk team yang mengerjakan -->
    <!-- <div class="team">
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="Profile Picture 1">
            <h3>Nama: Raffi</h3>
            <p class="contributor">Kontributor Utama</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="Profile Picture 2">
            <h3>Nama: Khafi</h3>
            <p class="non-contributor">Numpang Nama</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="Profile Picture 3">
            <h3>Nama: Tuza</h3>
            <p class="non-contributor">Numpang Nama</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="Profile Picture 4">
            <h3>Nama: Alif</h3>
            <p class="non-contributor">Numpang Nama</p>
        </div>
    </div> -->

    <script>
        function calculate(operation) {
            var num1 = parseFloat(document.getElementById('num1').value);
            var num2 = parseFloat(document.getElementById('num2').value);
            var result;

            // Logika perhitungan berdasarkan operasi yang dipilih
            if (operation === 'subtract') {
                result = num1 - num2;
            } else if (operation === 'divide') {
                result = num2 !== 0 ? num1 / num2 : 'Error (Division by zero)';
            }

            document.getElementById('result').innerText = 'Hasil: ' + result;
        }
    </script>
</body>
</html>
