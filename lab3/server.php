<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: another_page.php');
    exit();
}

$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$script_name = $_SERVER['PHP_SELF'];
$request_method = $_SERVER['REQUEST_METHOD'];
$file_path = __FILE__;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про сервер</title>
</head>
<body>
    <p>IP-адреса клієнта: <?php echo $ip; ?></p>
    <p>Браузер: <?php echo $user_agent; ?></p>
    <p>Назва скрипта: <?php echo $script_name; ?></p>
    <p>Метод запиту: <?php echo $request_method; ?></p>
    <p>Шлях до файлу на сервері: <?php echo $file_path; ?></p>
</body>
</html>
