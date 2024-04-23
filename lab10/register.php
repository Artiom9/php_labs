<?php
// Подключение к базе данных
include 'db_connect.php';
session_start();

// Проверка, если пользователь уже аутентифицирован, перенаправить его на главную страницу
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка, существует ли пользователь с таким же именем
    $check_query = "SELECT id FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($check_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_message = "Пользователь с таким логином уже существует.";
    } else {
        // Регистрация нового пользователя
        $register_query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $mysqli->prepare($register_query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();

        // Перенаправление на страницу входа после успешной регистрации
        header("Location: login.php");
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <form method="post">
            <div class="form-group">
                <label>Логин:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Зарегистрироваться">
        </form>
        <?php if (isset($error_message)): ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
