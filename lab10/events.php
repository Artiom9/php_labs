<?php
// Подключение к базе данных
include 'db_connect.php';
session_start();

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
    <title>Текущие мероприятия</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Текущие мероприятия</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название мероприятия</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($current_events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo $event['name']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
