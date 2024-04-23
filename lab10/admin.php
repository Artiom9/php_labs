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

// Обработка удаления мероприятия
if (isset($_GET['delete']) && $_GET['delete'] != '') {
    $event_id = $_GET['delete'];
    $delete_query = "DELETE FROM events WHERE id = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Обработка выхода из административной панели
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Обработка данных из формы добавления мероприятия
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];

    $insert_query = "INSERT INTO events (name, date) VALUES (?, ?)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $name, $date);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Получение списка текущих мероприятий из базы данных
$events_query = "SELECT id, name, date FROM events";
$result = $mysqli->query($events_query);
$current_events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $current_events[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Административная панель</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Административная панель</h1>
        <div>
            <a href="add_event.php" class="btn">Добавить мероприятие</a>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название мероприятия</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($current_events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo $event['name']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td>
                            <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn">Редактировать</a>
                            <a href="admin.php?delete=<?php echo $event['id']; ?>" class="btn">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form action="admin.php?logout" method="post">
            <input type="submit" value="Выйти">
        </form>
    </div>
</body>
</html>
