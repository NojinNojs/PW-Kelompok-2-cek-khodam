### 1. Tuliskan query SQL untuk insert ke tabel list_kodam tanpa variabel (statis)
```sql
INSERT INTO list_kodam (nama_kodam, jenis_kodam) VALUES ('Kodam Example', 'Jenis Example');
```

### 2. Fungsi dari kode `if (!empty($nama_kodam) && !empty($jenis_kodam))`
Kode `if (!empty($nama_kodam) && !empty($jenis_kodam))` berfungsi untuk memastikan bahwa kedua input, yaitu `nama_kodam` dan `jenis_kodam`, tidak kosong sebelum melanjutkan ke proses selanjutnya. Jika salah satu dari input tersebut kosong, maka kode di dalam blok `if` tidak akan dieksekusi.

### 3. Method yang digunakan pada form di atas
Method yang digunakan pada form di atas adalah POST.

### 4. Tuliskan kode program yang akan dijalankan ketika salah satu inputan tidak terisi
```php
echo '<p class="message error">Error: Semua field harus diisi.</p>';
```

### 5. Fungsi dari kode `$_POST['nama_kodam']`

Kode `$_POST['nama_kodam']` berfungsi untuk mengambil nilai dari input form dengan nama `nama_kodam` yang dikirimkan menggunakan method POST. Ini digunakan untuk mendapatkan data yang diinputkan pengguna dalam form HTML.