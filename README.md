
# Cek Khodam

Cek Khodam menggunakan PHP dengan database MySQL2


### Soal
1. Apa yang terjadi jika atribut `required` dihapus dari input form?
2. Apa fungsi atribut `pattern` pada HTML?
3. Bagaimana cara kerja validasi input pada kode tersebut?
4. Bagaimana cara kerja fungsi `getRandomKodam` dalam kode PHP tersebut?
5. Bagaimana cara menampilkan pesan error pada web menggunakan kode yang diberikan?

### Jawaban

1. **Apa yang terjadi jika atribut `required` dihapus dari input form?**

   Jika atribut `required` dihapus dari input form, pengguna dapat mengirimkan formulir tanpa mengisi inputan terlebih dahulu. Atribut `required` digunakan untuk memastikan bahwa pengguna memasukkan nilai sebelum mengirimkan formulir. Tanpa atribut ini, form dapat dikirim dengan input kosong, dan validasi harus sepenuhnya dilakukan di sisi server atau melalui JavaScript untuk menangani kasus di mana input kosong tidak diinginkan.

2. **Apa fungsi atribut `pattern` pada HTML?**

   Atribut `pattern` pada HTML digunakan untuk menentukan ekspresi reguler yang harus dipenuhi oleh nilai input sebelum formulir dapat dikirimkan. Ini adalah bentuk validasi sisi klien yang memastikan bahwa data yang dimasukkan oleh pengguna sesuai dengan format yang diharapkan. Pada kode di atas, `pattern="[A-Za-z\s]+"` mengharuskan input hanya terdiri dari huruf besar, huruf kecil, dan spasi. Jika input tidak sesuai dengan pola ini, form tidak akan bisa disubmit, dan pesan kesalahan yang sesuai akan ditampilkan.

3. **Bagaimana cara kerja validasi input pada kode tersebut?**

   Validasi input pada kode tersebut bekerja dalam beberapa langkah:
   - Ketika formulir disubmit, kode PHP memeriksa apakah metode pengiriman adalah POST.
   - Kemudian, kode memeriksa apakah nilai `khodam` telah diatur (dengan `isset`) dan menghapus spasi dari nilai input menggunakan `trim()`.
   - Kode memeriksa apakah input kosong dan memeriksa apakah input sesuai dengan pola yang ditentukan menggunakan fungsi `preg_match()` dengan regex `/^[A-Za-z\s]+$/`.
   - Jika input tidak valid, pesan kesalahan disimpan dalam variabel `$error`.
   - Jika validasi lolos, fungsi `getRandomKodam` dipanggil untuk mendapatkan data Kodam acak dan menampilkannya. Jika tidak ada data Kodam yang ditemukan, pesan kesalahan juga disimpan.

4. **Bagaimana cara kerja fungsi `getRandomKodam` dalam kode PHP tersebut?**

   Fungsi `getRandomKodam` bekerja sebagai berikut:
   - Fungsi ini menerima satu parameter, yaitu `$conn`, yang merupakan koneksi database PDO.
   - Fungsi menjalankan query SQL untuk memilih `nama_kodam` dan `jenis_kodam` dari tabel `list_kodam`.
   - Menggunakan metode `fetchAll(PDO::FETCH_ASSOC)`, semua baris hasil query diambil sebagai array asosiatif.
   - Jika ada data yang ditemukan (jumlah elemen dalam array lebih dari 0), fungsi memilih satu elemen secara acak menggunakan `mt_rand()`.
   - Elemen yang dipilih secara acak (berisi nama dan jenis Kodam) dikembalikan oleh fungsi.
   - Jika tidak ada data atau terjadi kesalahan, fungsi mengembalikan `null`.

5. **Bagaimana cara menampilkan pesan error pada web menggunakan kode yang diberikan?**

   Pesan error ditampilkan pada web dengan cara berikut:
   - Setelah validasi input, jika ada kesalahan, pesan kesalahan disimpan dalam variabel `$error`.
   - Jika `$error` tidak kosong, sebuah elemen `<div>` dengan kelas `'alert'` ditampilkan, berisi pesan kesalahan.
   - Sebuah script JavaScript digunakan untuk memastikan elemen `'alert'` ditampilkan di halaman.
   - Pesan error ditampilkan di bagian bawah form, memberikan umpan balik langsung kepada pengguna mengenai masalah yang terjadi.

