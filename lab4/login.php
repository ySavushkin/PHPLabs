<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = md5($password);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['username'] = $user['username'];
            header('Location: welcome.php');
        } else {
            echo "Incorrect username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
