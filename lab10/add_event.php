<?php
// Подключение к базе данных
include 'db_connect.php';
session_start();

// Проверка аутентификации пользователя
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Проверка роли пользователя (должен быть администратором)
if ($_SESSION['role'] != 'manager') {
    header("Location: index.php");
    exit();
}

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = $_POST['name'];
    $date = $_POST['date'];

    // Подготовка и выполнение запроса на добавление мероприятия в базу данных
    $query = "INSERT INTO events (name, date) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $name, $date);
    $stmt->execute();
    $stmt->close();

    // Перенаправление на страницу с текущими мероприятиями
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить мероприятие</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Добавить мероприятие</h1>
        <form method="post">
            <div class="form-group">
                <label>Название мероприятия:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Дата:</label>
                <input type="datetime-local" name="date" required>
            </div>
            <input type="submit" value="Добавить">
        </form>
    </div>
</body>
</html>
