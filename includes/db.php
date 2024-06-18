<?php
$servername = "localhost";
$username = "root";
$password = "galelio5204";
$dbname = "juara_jawara";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
