<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"]) || empty($_POST["password"])) {
        echo "All fields are required";
    } else {
        $login = $_POST["login"];
        $password = md5($_POST["password"]); // Хешируем пароль с помощью MD5

        // Сохраняем данные в файл
        $file = fopen("users.txt", "a") or die("Unable to open file!");
        fwrite($file, "$login:$password\n");
        fclose($file);

        http_response_code(201); // Отправляем HTTP-код 201 (Created)
        echo "User registered successfully";
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
