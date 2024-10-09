<?php
if (isset($_POST['name'])) {
    // Встановлюємо cookie на 7 днів
    setcookie('user_name', $_POST['name'], time() + (7 * 86400));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Видаляємо cookie
if (isset($_POST['delete_cookie'])) {
    setcookie('user_name', '', time() - 3600);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Привітання</title>
</head>
<body>
    <?php if (isset($_COOKIE['user_name'])): ?>
        <h1>Привіт, <?php echo htmlspecialchars($_COOKIE['user_name']); ?>!</h1>
        <form method="post">
            <button type="submit" name="delete_cookie">Видалити cookie</button>
        </form>
    <?php else: ?>
        <form method="post">
            <label>Введіть ваше ім'я: <input type="text" name="name" required></label>
            <button type="submit">Надіслати</button>
        </form>
    <?php endif; ?>
</body>
</html>
