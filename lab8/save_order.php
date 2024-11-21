<?php
header('Content-Type: application/json');

$host = 'postgres';
$db = 'laravel-getting-started';
$user = 'laravel-getting-started-user';
$password = 'laravel-getting-started-password';
$port = '5432';

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $orderNumber = $_POST['order-number'];
    $weight = $_POST['weight'];
    $city = $_POST['city'];
    $deliveryOption = $_POST['delivery-option'];
    $branch = $_POST['branch'];

    // Перевірка коректності даних
    if (empty($orderNumber) || empty($weight) || empty($city) || empty($deliveryOption) || empty($branch)) {
        echo json_encode(['success' => false, 'message' => 'Всі поля повинні бути заповнені.']);
        exit;
    }

    // Збереження в базу
    $stmt = $conn->prepare("INSERT INTO orders (order_number, weight, city, delivery_option, branch) VALUES (:order_number, :weight, :city, :delivery_option, :branch)");
    $stmt->bindParam(':order_number', $orderNumber);
    $stmt->bindParam(':weight', $weight);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':delivery_option', $deliveryOption);
    $stmt->bindParam(':branch', $branch);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Замовлення успішно оформлено.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Помилка збереження: ' . $e->getMessage()]);
}
