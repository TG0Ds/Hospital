<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Halaman Utama</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body class="bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('background1.jpg');">
  
<div class="container mx-auto px-4 py-4">
    <nav class="bg-gray-100 p-4 rounded-lg shadow-md flex justify-between">
        <a href="#" class="text-xl font-semibold">My App</a>
        <ul class="flex space-x-4">
            <li><a href="kunjungan.php" class="text-blue-500 hover:text-blue-700">kunjungan</a></li>
            <li><a href="pasien.php" class="text-blue-500 hover:text-blue-700">Pasien</a></li>
            <li><a href="dokter.php" class="text-blue-500 hover:text-blue-700">Dokter</a></li>
        </ul>
    </nav>

    <div class="mt-8">
        <h3 class="text-xl font-bold pb-3">Tabel Pasien</h3>
        <a href="tambahpasien.php" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg text-sm">Tambah Data</a>
    </div>

    <div class="mt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">ID Pasien</th>
                    <th class="py-3 px-6 text-left">Nama Pasien</th>
                    <th class="py-3 px-6 text-left">Jenis Kelamin</th>
                    <th class="py-3 px-6 text-left">Alamat</th>
                    <th class="py-3 px-6 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                include '../config.php';
                $no = 1;
                $hasil = $konek->query("SELECT * FROM pasien");
                while ($row = $hasil->fetch_assoc()) {
                ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left font-bold"><?= $no++; ?></td>
                    <td class="py-3 px-6 text-left font-bold"><?= $row['idPasien']; ?></td>
                    <td class="py-3 px-6 text-left font-bold"><?= $row['nmPasien']; ?></td>
                    <td class="py-3 px-6 text-left font-bold"><?= $row['jk']; ?></td>
                    <td class="py-3 px-6 text-left font-bold"><?= $row['alamat']; ?></td>
                    <td class="py-3 px-6 text-left flex items-center space-x-2">
                        <a href="editpasien.php?edit=<?= $row['idPasien']; ?>" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form method="post" action="deletepasien.php" onsubmit="return confirmDeletion(this);">
                            <input type="hidden" name="id" value="<?= $row['idPasien']; ?>">
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg relative w-80">
        <span class="absolute top-2 right-2 text-gray-600 cursor-pointer" onclick="closeModal()">&times;</span>
        <img src="warning.png" alt="Warning" class="mx-auto w-12 h-12">
        <p class="text-center text-gray-800 mt-4">Apakah Anda yakin ingin menghapus data pasien ini?</p>
        <div class="mt-6 flex flex-col items-center space-y-4">
            <button id="confirmDelete" class="bg-red-500 text-white w-3/4 py-2 rounded-lg">Delete</button>
            <button class="bg-white text-gray-700 w-3/4 py-2 rounded-lg border border-gray-300" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let deleteForm;

    function confirmDeletion(form) {
        deleteForm = form;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
        return false; // Prevent the default form submission
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.remove('flex');
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('confirmDelete').onclick = function() {
        deleteForm.submit();
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target === document.getElementById('deleteModal')) {
            closeModal();
        }
    }
</script>

</body>
</html>
