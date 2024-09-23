<?php
include '../koneksi.php'; // Menyertakan file koneksi database

// Mengambil data dari tabel list_kodam
$sql = "SELECT * FROM list_kodam";
$result = $conn->query($sql);

if ($result === false) {
    // Handle query error
    die("Query failed: " . $conn->error);
}

$kodamList = []; // Menyimpan hasil query dalam array
while ($row = $result->fetch_assoc()) {
    $kodamList[] = $row; // Menambahkan setiap baris hasil ke array
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kodam List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Container Utama -->
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-semibold text-center">Kodam List</h1>
            <a href="create.php" class="bg-blue-600 hover:bg-blue-800 transition-all text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center space-x-2">
                <i class="fas fa-plus"></i> 
                <span>Create New Kodam</span>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table id="kodamTable" class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Khodam</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Jenis Khodam</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="kodamList" class="bg-white divide-y divide-gray-200">
                    <?php 
                    foreach ($kodamList as $index => $kodam): ?> 
                    <tr id="row-<?php echo $kodam['id']; ?>" class="hover:bg-gray-50 transition-all">
                        <td class="px-6 py-4 whitespace-nowrap serial-number"><?php echo $index + 1; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($kodam['nama_kodam']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($kodam['jenis_kodam']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="update.php?id=<?php echo urlencode($kodam['id']); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all">
                                <i class="fas fa-edit"></i> Update
                            </a>
                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all ml-2" onclick="confirmDelete(<?php echo $kodam['id']; ?>)">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal konfirmasi hapus -->
        <div id="deleteModal" class="fixed z-50 inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center transition-opacity duration-300">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96 p-6">
                <h2 class="text-2xl font-bold mb-4">Konfirmasi Hapus</h2>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus Kodam ini?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelBtn" class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded-lg transition-all">Batal</button>
                    <button id="confirmDeleteBtn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-all">Hapus</button>
                </div>
            </div>
        </div>

        <!-- Modal Undo -->
        <div id="undoModal" class="fixed z-50 inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center transition-opacity duration-300">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96 p-6">
                <h2 class="text-2xl font-bold mb-4">Data Telah Dihapus</h2>
                <p class="text-gray-600 mb-6">Apakah Anda ingin mengembalikan data yang telah dihapus?</p>
                <div class="flex justify-end space-x-4">
                    <button id="undoBtn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-all">Undo</button>
                    <button id="finalDeleteBtn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-all">Hapus Permanen</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deletedId = null;

        function confirmDelete(id) {
            deletedId = id;
            const modal = document.getElementById('deleteModal');

            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('opacity-100');
        }

        // Tombol "Hapus" dalam modal
        document.getElementById('confirmDeleteBtn').onclick = function() {
            deleteFromTable(deletedId);
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden'); // Tutup modal setelah tombol ditekan
        };

        // Tombol "Batal" dalam modal
        document.getElementById('cancelBtn').onclick = function() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        };

        // Menghapus baris dari tabel dan menampilkan modal Undo
        function deleteFromTable(id) {
            const row = document.getElementById(`row-${id}`);
            if (row) {
                row.style.display = 'none'; // Sembunyikan baris dari tabel
                updateSerialNumbers(); // Update nomor urut

                // Tampilkan modal Undo
                const undoModal = document.getElementById('undoModal');
                undoModal.classList.remove('hidden');
                undoModal.classList.add('opacity-100');
            }
        }

        // Tombol Undo dalam modal
        document.getElementById('undoBtn').onclick = function() {
            const row = document.getElementById(`row-${deletedId}`);
            if (row) {
                row.style.display = ''; // Tampilkan kembali baris yang tersembunyi
                updateSerialNumbers(); // Update nomor urut
            }
            const undoModal = document.getElementById('undoModal');
            undoModal.classList.add('hidden'); // Tutup modal Undo
            deletedId = null;
        };

        // Tombol Final Hapus dalam modal
        document.getElementById('finalDeleteBtn').onclick = function() {
            const undoModal = document.getElementById('undoModal');
            undoModal.classList.add('hidden'); // Tutup modal Undo
            finalizeDelete(); // Lanjutkan ke penghapusan permanen
        };

        // Fungsi untuk menghapus data dari database
        function finalizeDelete() {
            window.location.href = `delete.php?id=${deletedId}`;
        }

        // Fungsi untuk mengupdate penomoran urut setelah perubahan
        function updateSerialNumbers() {
            const rows = document.querySelectorAll('#kodamList tr');
            let counter = 1;
            rows.forEach((row) => {
                if (row.style.display !== 'none') {
                    const serialCell = row.querySelector('.serial-number');
                    serialCell.textContent = counter;
                    counter++;
                }
            });
        }
    </script>

</body>
</html>
