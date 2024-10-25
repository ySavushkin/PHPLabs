<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    echo "Будь ласка, увійдіть до системи!";
    exit();
}

$newUsername = $_POST['username'];
$newEmail = $_POST['email'];

if (empty($newUsername) && empty($newEmail)) {
    echo "Не введено нових даних для оновлення!";
    exit();
}

try {
    if (empty($newUsername) || empty($newEmail)) {
        $stmt = $conn->prepare("SELECT username, email FROM users WHERE username = :old_username");
        $stmt->bindParam(':old_username', $_SESSION['user']);
        $stmt->execute();
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($newUsername)) {
            $newUsername = $currentData['username'];
        }
        
        if (empty($newEmail)) {
            $newEmail = $currentData['email'];
        }
    }

    $stmt = $conn->prepare("UPDATE users SET username = :username, email = :email WHERE username = :old_username");
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':email', $newEmail);
    $stmt->bindParam(':old_username', $_SESSION['user']);

    $stmt->execute();

    if ($newUsername !== $_SESSION['user']) {
        $_SESSION['user'] = $newUsername;
    }

    echo "success";
} catch (PDOException $e) {
    echo "Помилка при оновленні даних: " . $e->getMessage();
}
