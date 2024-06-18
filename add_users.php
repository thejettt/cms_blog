<?php
include 'includes/db.php';

// Fungsi untuk menambahkan pengguna
function addUser($conn, $username, $password, $role) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $hashedPassword, $role);
    if ($query->execute()) {
        echo "$role added successfully.<br>";
    } else {
        echo "Error adding $role: " . $query->error . "<br>";
    }
}

// Tambahkan Admin dengan password 111
addUser($conn, 'admin', '111', 'admin');

// Tambahkan User dengan password 222
addUser($conn, 'user', '222', 'user');

$conn->close();
?>
