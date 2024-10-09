<?php
session_start();

$inactive = 3;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactive) {
    session_unset();
    session_destroy();
    $session_expired = true;
} else {
    $_SESSION['last_activity'] = time(); 
    $session_expired = false;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сесія з таймаутом</title>
</head>
<body>
    <?php if ($session_expired): ?>
        <h1>Сесія завершена через неактивність</h1>
        <p>Будь ласка, оновіть сторінку або перезавантажте її, щоб розпочати нову сесію.</p>
    <?php else: ?>
        <h1>Ваша сесія активна</h1>
        <form method="post">
            <button type="submit" name="action">ДІЯ</button>
        </form>
    <?php endif; ?>
</body>
</html>
