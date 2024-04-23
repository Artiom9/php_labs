<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"]) || empty($_POST["password"])) {
        echo "All fields are required";
    } else {
        $login = $_POST["login"];
        $password = md5($_POST["password"]); // Хешируем введенный пароль

        // Проверяем наличие пользователя в файле
        $file = fopen("users.txt", "r") or die("Unable to open file!");
        $user_found = false;
        while (!feof($file)) {
            $line = trim(fgets($file));
            $parts = explode(":", $line);
            if ($parts[0] == $login && $parts[1] == $password) {
                $user_found = true;
                break;
            }
        }
        fclose($file);

        if ($user_found) {
            header("Location: images.php"); // Перенаправляем пользователя на страницу с изображениями
            exit;
        } else {
            echo "Invalid login or password";
        }
    }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <div>
        <label>Login: <input type="text" name="login"></label>
    </div>
    <div>
        <label>Password: <input type="password" name="password"></label>
    </div>
    <div>
        <input type="submit" value="Register">
    </div>
</form>
