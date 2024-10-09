<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (isset($_POST['item']) && !empty($_POST['item'])) {
    $_SESSION['cart'][] = $_POST['item'];

    setcookie('previous_cart', json_encode($_SESSION['cart']), time() + (7 * 86400));

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$cart = $_SESSION['cart'];

$previous_cart = json_decode($_COOKIE['previous_cart'] ?? '[]', true);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
</head>
<body>
    <h1>Корзина покупок</h1>
    <form method="post">
        <label>Товар: <input type="text" name="item" required></label>
        <button type="submit">Додати до корзини</button>
    </form>

    <h2>Товари в корзині:</h2>
    <ul>
        <?php foreach ($cart as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Попередні покупки:</h2>
    <ul>
        <?php foreach ($previous_cart as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
