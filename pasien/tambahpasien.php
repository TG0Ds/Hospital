<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $idPasien = $_POST['idPasien'];
    $nmPasien = $_POST['nmPasien'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];

    // Insert into the database
    $sql = "INSERT INTO pasien (idpasien, nmpasien, jk, alamat) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($konek, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $idPasien, $nmPasien, $jk, $alamat);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data pasien telah ditambahkan"); window.location.href = "pasien.php";</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '");</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error: ' . mysqli_error($konek) . '");</script>';
    }
    mysqli_close($konek);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Tambah Data Pasien</title>
    <link href="../output.css" rel="stylesheet">
    <style>
        body {
            background-color: gray;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container bg-white rounded-lg shadow-lg p-8 max-w-md max-h-screen overflow-auto">
        <h3 class="text-center text-xl font-semibold mb-4">Tambah Data Pasien</h3>
        <form action="tambahpasien.php" method="POST">
            <div class="mb-4">
                <label for="idPasien" class="block text-gray-700 mb-2">ID Pasien</label>
                <input type="text" class="w-full p-2 border border-gray-300 rounded-md" name="idPasien" placeholder="ID Pasien" required>
            </div>
            <div class="mb-4">
                <label for="nmPasien" class="block text-gray-700 mb-2">Nama Pasien</label>
                <input type="text" class="w-full p-2 border border-gray-300 rounded-md" name="nmPasien" placeholder="Nama Pasien" required>
            </div>
            <div class="mb-4">
                <label for="jk" class="block text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex items-center">
                    <input type="radio" class="mr-2" name="jk" value="Perempuan" required> Perempuan
                </div>
                <div class="flex items-center mt-2">
                    <input type="radio" class="mr-2" name="jk" value="Laki-laki" required> Laki-laki
                </div>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="Alamat" class="w-full p-2 border border-gray-300 rounded-md" required></textarea>
            </div>
            <div class="mt-6">
                <input type="submit" name="simpan" value="Simpan" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
            </div>
        </form>
        <a href="pasien-home.php" class="block text-center w-full mt-4 bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">Kembali</a>
    </div>
</body>
</html>
