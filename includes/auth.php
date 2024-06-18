<?php
function checkAdmin() {
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../login.php");
        exit();
    }
}

function checkUser() {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
}
?>
