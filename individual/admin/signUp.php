<?php
session_start();
require 'config.php';

if ((isset($_POST["login"])) and (!empty($_POST['login'])) and (isset($_POST["pass"])) and (!empty($_POST['pass']))) {
	$login = $_POST["login"];
	$password = $_POST["pass"];
	$mesaj = '';

	if (!preg_match('/^[A-z0-9]{5,16}$/', $login)) {
		$mesaj = '<div class="alert alert-danger">Логин должен содержать только буквы и цифры (от 5 до 16 символов)!</div>';
	}
	if (!preg_match('/^[A-z0-9]{5,16}$/', $password)) {
		$mesaj = '<div class="alert alert-danger">Пароль должен содержать только буквы и цифры (от 5 до 16 символов)!</div>';
	}

	if ($mesaj == '') {
		$exist = false;

		if (!file_exists(FILE_ACCOUNTS)) {
			$hash = md5($password);
			file_put_contents(FILE_ACCOUNTS, "$login:$hash\n", FILE_APPEND);
			$initial = true;
		} else {
			$log = fopen(FILE_ACCOUNTS, "r+") or die("Файл не найден!");
			while (!feof($log)) {
				$extras = trim(fgets($log));
				if ($extras == $login . ':' . md5($password)) {
					$exist = true;
				}
			}
			fclose($log);
		}

		if ($exist == true) {
			$mesaj = '<div class="alert alert-danger">Такой аккаунт уже существует!<br />Введите другие данные для входа!</div>';
		} elseif ($initial == true) {
			$mesaj = '<div class="alert alert-danger">Первый аккаунт создан!</div>';
		} else {
			$hash = md5($password);
			file_put_contents(FILE_ACCOUNTS, "$login:$hash\n", FILE_APPEND);
			$mesaj = '<div class="alert alert-success">Аккаунт был создан!</div>';
			header('Location: /admin/');
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
		<a href="index.php" class="navbar">Вход</a>
	</div>
</nav>

<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Регистрация
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
							<div class="mb-3">
								<label for="confirm_password" class="form-label">Подтверждение пароля</label>
								<input type="password" class="form-control" id="confirm_password" name="confirm_pass" />
							</div>
							<input type="submit" value="Зарегестрироваться" class="btn btn-primary" name="ok" />
						</form>
						<?php
						if (empty($_REQUEST['login']) || empty($_REQUEST['pass'])) {
							echo "<br /><div class='alert alert-warning'>*Заполните все поля!</div>";
						}
						echo '<br />' . ($mesaj ?? '');
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>