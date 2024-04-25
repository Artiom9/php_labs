<?php
session_start();
require 'config.php';

if (isset($_REQUEST['ok'])) {
    if ((isset($_POST["login"])) and (!empty($_POST['login'])) and (isset($_POST["pass"])) and (!empty($_POST['pass']))) {
        $login = trim($_POST["login"]);
        $password = trim($_POST["pass"]);
        $err = '';

        if (!preg_match('/^[A-z0-9]{5,16}$/', $login)) {
            $err = '<div class="alert alert-danger">Логин должен содержать только буквы и цифры (от 5 до 16 символов)!</div>';
        }
        if (!preg_match('/^[A-z0-9]{5,16}$/', $password)) {
            $err = '<div class="alert alert-danger">Пароль должен содержать только буквы и цифры (от 5 до 16 символов)!</div>';
        }

        if ($err == '') {
            $log = fopen(FILE_ACCOUNTS, "r") or die("Файл не найден!");
            $exist = false;
            while (!feof($log)) {
                $extras = trim(fgets($log));
                $date_cont = explode(":", $extras);
                if (($date_cont[0] == $login) and ($date_cont[1] == md5($password))) {
                    $exist = true;
                }
            }
            fclose($log);
            if ($exist) {
                $_SESSION['user'] = $login;
                header('Location: /admin/view_data.php');
            } else {
                $err = '<div class="alert alert-danger">Логин или пароль введены не верно!</div>';
            }
        }
    }
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
        <a href="signUp.php" class="navbar">Регистрация</a>
    </div>
</nav>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Вход
                    </div>
                    <div class="card-body">
                        <form method="POST" autocomplete="off" action="<?php $_SERVER['SCRIPT_NAME'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Логин</label>
                                <input type="text" class="form-control" id="name" name="login" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="pass" />
                            </div>
                            <input type="submit" value="Войти" class="btn btn-primary" name="ok" />
                        </form>
                        <?= '<br />' . ($err ?? '') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>