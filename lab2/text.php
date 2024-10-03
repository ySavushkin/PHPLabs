<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $logText = $_POST['logText'];

    if (!empty($logText)) {
        $file = 'log.txt';
        //FILE_APPEND - adds new data to file, but didnt delete old
        //LOCK_EX - concurrency key
        //PHP_EOL - new row symbol
        file_put_contents($file, $logText . PHP_EOL, FILE_APPEND | LOCK_EX);
        echo "Текст успішно збережено!<br>";
    } else {
        echo "Введіть текст для збереження.";
    }

    if (file_exists('log.txt')) {
        echo "<h2>Зміст файлу log.txt:</h2>";
        //nl2br - inserts HTML line breaks (<br> or <br />) in front of each newline (\n) in a string
        echo nl2br(file_get_contents('log.txt'));
    }
}

