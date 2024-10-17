<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $idPasien = $_POST['idPasien'];
    $nmPasien = $_POST['nmPasien'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $konek->query("UPDATE pasien SET nmPasien='$nmPasien', jk='$jk', alamat='$alamat' WHERE idPasien='$idPasien'");
    header("Location: pasien.php");
    exit;
}

if (isset($_GET['edit'])) {
    $idPasien = $_GET['edit'];
    $panggil = $konek->query("SELECT * FROM pasien WHERE idPasien='$idPasien'");
} else {
    header("Location: pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My App | Edit Data Pasien</title>
    <link href="../output.css" rel="stylesheet"> <!-- Ensure your Tailwind CSS file is linked -->
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
        <h3 class="text-center text-xl font-semibold mb-4">Edit Data Pasien</h3>
        <?php while ($row = $panggil->fetch_assoc()) { ?>
        <form action="editpasien.php" method="POST">
            <input type="hidden" name="idPasien" value="<?= $row['idPasien'] ?>">
            <div class="mb-4">
                <label for="nmPasien" class="block text-gray-700 mb-2">Nama Pasien</label>
                <input type="text" class="w-full p-2 border border-gray-300 rounded-md" name="nmPasien" placeholder="Nama Pasien" value="<?= $row['nmPasien'] ?>" required>
            </div>
            <div class="mb-4">
                <label for="jk" class="block text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex items-center">
                    <input type="radio" class="mr-2" name="jk" value="Perempuan" <?php if (($row['jk']) === "Perempuan") { echo "checked"; } ?> required> Perempuan
                </div>
                <div class="flex items-center mt-2">
                    <input type="radio" class="mr-2" name="jk" value="Laki-laki" <?php if (($row['jk']) === "Laki-laki") { echo "checked"; } ?> required> Laki-laki
                </div>
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="Alamat" class="w-full p-2 border border-gray-300 rounded-md" required><?= $row['alamat'] ?></textarea>
            </div>
            <div class="mt-6">
                <input type="submit" name="update" value="Simpan" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
            </div>
        </form>
        <a href="pasien.php" class="block text-center w-full mt-4 bg-gray-500 text-white p-2 rounded-md hover:bg-gray-600">Kembali</a>
        <?php } ?>
    </div>
</body>
</html>
