<?php
require 'config.php';

session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Резервирование</title>
    <link rel="icon" href="../images/icon.png" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <a href="logout.php" class="navbar">Выход</a>
    </div>
</nav>

<body>
    <div class="myData">
        <h1>Данные, хранящиеся в файле, о сделанных заказах</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Номер телефона</th>
                    <th>Email</th>
                    <th>Дата прибытия</th>
                    <th>Дата отбытия</th>
                    <th>Количество человек</th>
                    <th>Тип камеры</th>
                    <th>Комментарии</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $file = fopen(FILE_RESERVATIONS, "r") or die("Файл не найден!");
                while (!feof($file)) {
                    echo "<tr>";
                    $record = trim(fgets($file));
                    if (strlen($record) < 2)
                        continue;
                    $row = explode(",", $record);
                    foreach ($row as $item) {
                        echo "<td>" . $item . "</td>";
                    }
                    echo "</tr>";
                }
                fclose($file);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>