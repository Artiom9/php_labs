# Отчет по пятой-шестой лабораторной работе

1. [Инструкции по запуску проекта](#1-инструкции-по-запуску-проекта).
2. [Описание проекта](#2-описание-проекта).
3. [Краткая документация к проекту](#3-краткая-документация-к-проекту).
4. [Примеры использования проекта с приложением скриншотов или фрагментов кода](#4-пример-использования-проекта-с-приложением-скриншотов).
5. [Список использованных источников](#5-список-использованных-источников).

## 1. Инструкции по запуску проекта

Данные инструкции действительны при использовании PhpStorm, в ином случае, воспользуйтесь приведенной ссылкой:
[запуск проекта с gitHub](https://www.youtube.com/watch?v=6N6JFynR0gM)

1. Клонируйте репозиторий:
   ```bash
   https://github.com/Artiom9/php_labs.git
2. Запустите проект:
   <!-- Если у вас есть веб-сервер (например, Apache или Nginx), настройте его так, чтобы корневой каталог указывал на
   каталог вашего проекта.  
   Если у вас нет веб-сервера, вы можете использовать встроенный сервер PHP для тестирования: -->
   ```bash 
   php -S localhost:8000 lab_5-6\lab5-1.php
   php -S localhost:8000 lab_5-6\lab5-2.php
   php -S localhost:8000 lab_5-6\lab5-3.php
   php -S localhost:8000 lab_5-6\lab5-4-1.php
   php -S localhost:8000 lab_5-6\lab5-4-2.php

## 2. Описание проекта

Эта лабораторная работа направлена на создание базовой системы регистрации и авторизации пользователей на веб-сайте. Студентам предлагается создать HTML-формы для ввода данных пользователей, написать PHP-скрипты для обработки этих данных и сохранения их в файле. Кроме того, студентам предстоит реализовать механизм хеширования паролей и проверки подлинности пользователей при входе на сайт. Эта лабораторная работа позволяет понять основы безопасности веб-приложений и применение HTTP-кодов для обработки различных сценариев работы с пользовательскими данными.

## 3. Краткая документация к проекту
1. Вставить с помощью fwrite ещё три записи
```php
<?php
fwrite($file, "6. Emily Johnson, 1995, 8887776665554\n");
fwrite($file, "7. Jessica Lee, 1993, 7778889990001\n");
fwrite($file, "8. Sarah Miller, 1985, 1112223334445\n");
?>
```

2. Заменить fwrite на file_put_contents
```php
<?php
$new_data = "6. Emily Johnson, 1995, 8887776665554\n";
$new_data .= "7. Jessica Lee, 1993, 7778889990001\n";
$new_data .= "8. Sarah Miller, 1985, 1112223334445\n";
file_put_contents("file.txt", $new_data, FILE_APPEND);
?>
```

3. Добавить код для сохранения данных в файл
```php
$file = fopen('messages.txt', 'a+') or die("Недоступный файл!");
foreach ($data as $field => $value) {
    fwrite($file, "$field: $value\n");
}
fwrite($file, "\n");
fclose($file);
```

4.1. Скрипт обработки данных регистрации
```php
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
```

4.2. Скрипт обработки данных авторизации
```php
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
```

## 4. Пример использования проекта (с приложением скриншотов)

![Пример работы программы](img/image1.png.png)
![Пример сохранения формы](img/image2.png.png)
![Пример регистрации](img/image3.png.png)
![Пример входа пользователя](img/image4.png.png)

## 5. Список использованных источников

1. [Функции в PHP](https://www.php.net/manual/ru/functions.user-defined.php)