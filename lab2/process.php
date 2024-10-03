<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file'];
        $allowedTypes = ['image/png', 'image/jpeg'];
        $maxSize = 2 * 1024 * 1024; // 2 mb

        //in_array searches an array for a specific value
        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
            $uploadDir = 'uploads/';
            $filePath = $uploadDir.basename($file['name']);

            if (file_exists($filePath)) {
                echo "Файл з такою назвою вже існує!<br>";
                
            } else if (move_uploaded_file($file['tmp_name'], $filePath)) {
                echo "Файл успішно завантажено!<br>";
                echo "Ім'я файлу: " . basename($filePath) . "<br>";
                echo "Тип файлу: " . $file['type'] . "<br>";
                echo "Розмір файлу: " . round($file['size'] / 1024, 2) . " КБ<br>";
                echo '<a href="' . $filePath . '">Завантажити файл</a>';
            } else {
                echo "Помилка при завантаженні файлу.";
            }
        } else {
            echo "Недозволений тип файлу або файл перевищує максимальний розмір 2 МБ.";
        }
    } else {
        echo "Файл не завантажено.";
    }
}

