<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

echo "Добро пожаловать, " . $_SESSION['username'] . "!";
?>
