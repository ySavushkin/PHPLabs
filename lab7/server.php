<?php
session_start();
require 'db.php';

if ($_POST['action'] == 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "Користувач з такою електронною поштою вже існує!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        echo "success";
    }
}

if ($_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email"); //щоб уникнути ін'єкцій
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); //отримаємо рядок с юзером, або false

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            echo "success";
        } else {
            echo "Неправильний пароль!";
        }
    } else {
        echo "Користувача з такою електронною поштою не знайдено!";
    }
}
?>
