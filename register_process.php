<?php
include 'config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role']; // Ambil role dari input form jika ada

$sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
