<?php
session_start();

// Перевірка даних для входу
if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($_POST['login'] == 'admin' && $_POST['password'] == 'password') {
        $_SESSION['user'] = $_POST['login'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Невірний логін або пароль.";
    }
}

// Вихід з сесії
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Привіт, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <form method="post">
            <button type="submit" name="logout">Вийти</button>
        </form>
    <?php else: ?>
        <form method="post">
            <label>Логін: <input type="text" name="login" required></label><br>
            <label>Пароль: <input type="password" name="password" required></label><br>
            <button type="submit">Увійти</button>
        </form>
    <?php endif; ?>
</body>
</html>
