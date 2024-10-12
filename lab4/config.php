<?php
$host = 'postgres';
$db = 'laravel-getting-started';
$user = 'laravel-getting-started-user';
$password = 'laravel-getting-started-password';
$port = '5432';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection eror: " . $e->getMessage());
}
?>
