<?php
define('FILE_RESERVATIONS', 'admin/data/reservations.txt');

function validateData($data)
{
    return htmlspecialchars(trim($data));
}

$name = $surname = $phone = $email = $int_date = $exit_date = $nmbr = $type = $obs = '';
$err = [];
if (!empty($_POST["ok"])) {
    if (isset($_POST["name"]) && (!empty($_POST["name"]))) {
        $name = validateData($_POST["name"]);
        if (!preg_match('/^[А-яA-z]{2,16}$/u', $name)) {
            $err['name'] = "Имя должно содержать только буквы (от 2 до 16 символов)!";
        }
    } else {
        $err['name'] = "Введите фамилию!";
    }
    if (isset($_POST["surname"]) && (!empty($_POST["surname"]))) {
        $surname = validateData($_POST["surname"]);
        if (!preg_match('/^[А-яA-z]{2,16}$/u', $name)) {
            $err['surname'] = "Фамилия должно содержать только буквы (от 2 до 16 символов)!";
        }
    } else {
        $err['surname'] = "Введите имя!";
    }
    if (isset($_POST["phone"]) && (!empty($_POST["phone"]))) {
        $phone = validateData($_POST["phone"]);
        if (!preg_match('/^\d+$/', $phone)) {
            $err['phone'] = "Номер телефона должен содержать только цифры!";
        }
    } else {
        $err['phone'] = "Введите номер телефона!";
    }
    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = validateData($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err['email'] = "Некорректный формат email!";
        }
    } else {
        $err['email'] = "Введите email!";
    }
    if (isset($_POST["int_date"]) && (!empty($_POST["int_date"]))) {
        $int_date = validateData($_POST["int_date"]);
    } else {
        $err['int_date'] = "Введите дату прибытия!";
    }
    if (isset($_POST["exit_date"]) && (!empty($_POST["exit_date"]))) {
        $exit_date = validateData($_POST["exit_date"]);
    } else {
        $err["exit_date"] = "Введите дату отбытия!";
    }
    if (isset($_POST["nmbr"]) && (!empty($_POST["nmbr"]))) {
        $nmbr = validateData($_POST["nmbr"]);
        if (!preg_match('/^[1-5]$/', $nmbr)) {
            $err["nmbr"] = "Номер телефона должен содержать только цифры!";
        }
    } else {
        $err["nmbr"] = "Введите количество человек!";
    }
    if (isset($_POST["type"]) && (!empty($_POST["type"]))) {
        $types = ['lux', 'econom', 'apartament'];
        $type = validateData($_POST["type"]);
        if (!in_array($type, $types)) {
            $err["type"] = "Введите корректный тип номера!";
        }
    } else {
        $err["type"] = "Введите тип номера!";
    }
    $obs = validateData($_POST["obs"]) ?? "-";
    if (strlen($obs) > 200) {
        $err["obs"] = "Слишком большой комментарий!";
    }

    if (empty($err)) {
        $data = "$name,$surname,$phone,$email,$int_date,$exit_date,$nmbr,$type,$obs\n";
        file_put_contents(FILE_RESERVATIONS, $data, FILE_APPEND) or die('Файл не найден!');
    }
}
