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

    // Подготовка и выполнение запроса к базе данных для аутентификации пользователя
    $query = "SELECT id, role FROM users WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // Если найден пользователь с таким логином и паролем, аутентифицировать его и перенаправить на главную страницу
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $role);
        $stmt->fetch();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Неправильный логин или пароль.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Вход</h1>
        <form method="post">
            <div class="form-group">
                <label>Логин:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Войти">
        </form>
        <?php if (isset($error_message)): ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
