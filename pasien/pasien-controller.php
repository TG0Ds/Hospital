<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "hospital";

$konek = mysqli_connect($host, $user, $password, $database);

if (!$konek) {
    die("Connection failed: " . mysqli_connect_error());
}

// Determine which page to include based on the 'action' parameter
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'edit' && isset($_GET['idPasien'])) {
        // Load the edit page if action is 'edit' and idPasien is provided
        include 'editpasien.php';
    } elseif ($action == 'add') {
        // Load the add page if action is 'add'
        include 'tambahpasien.php';
    } else {
        // If the action is unrecognized, load the home page
        include 'pasien-home.php';
    }
} else {
    // Default to showing pasien-home.php if no action is specified
    include 'pasien-home.php';
}
?>
