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

// Получение ID мероприятия из параметров запроса
if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}
$event_id = $_GET['id'];

// Получение информации о мероприятии из базы данных
$event_query = "SELECT name, date FROM events WHERE id = ?";
$stmt = $mysqli->prepare($event_query);
$stmt->bind_param("i", $event_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $date);
$stmt->fetch();
$stmt->close();

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];

    // Обновление данных о мероприятии в базе данных
    $update_query = "UPDATE events SET name = ?, date = ? WHERE id = ?";
    $stmt = $mysqli->prepare($update_query);
    $stmt->bind_param("ssi", $name, $date, $event_id);
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
    <title>Редактировать мероприятие</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Редактировать мероприятие</h1>
        <form method="post">
            <div class="form-group">
                <label>Название мероприятия:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label>Дата:</label>
                <input type="datetime-local" name="date" value="<?php echo date('Y-m-d\TH:i', strtotime($date)); ?>" required>
            </div>
            <input type="submit" value="Сохранить">
        </form>
    </div>
</body>
</html>
