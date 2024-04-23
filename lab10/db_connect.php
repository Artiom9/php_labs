<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "event_platform";

// Создание подключения к базе данных
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>
