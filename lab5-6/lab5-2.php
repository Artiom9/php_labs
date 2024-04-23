<?php
//создание файла
$file = fopen("file.txt", "w") or die("Ошибка создания файла!");
//Вводим данные в файл
fwrite($file, "1. William Smith, 1990, 2344455666677\n");
fwrite($file, "2. John Doe, 1988, 4445556666787\n");
fwrite($file, "3. Michael Brown, 1991, 7748956996777\n");
fwrite($file, "4. David Johnson, 1987, 5556667779999\n");
fwrite($file, "5. Robert Jones, 1992, 99933456678888\n");
//Закрываем файл
fclose($file);
//Открываем файл для добавления данных
$file = fopen("file.txt", "a") or die("Ошибка открытия для добавления
данных!");
if (!$file) {
    echo ("Не был найден файл для добавления данных!");
} else {
    // Добавьте в файл с помощью функции file_put_contents() еще 3 записи
    $new_data = "6. Emily Johnson, 1995, 8887776665554\n";
    $new_data .= "7. Jessica Lee, 1993, 7778889990001\n";
    $new_data .= "8. Sarah Miller, 1985, 1112223334445\n";
    file_put_contents("file.txt", $new_data, FILE_APPEND);
}
fclose($file);
//Открываем файл для чтения из него
$file = fopen("file.txt", "r") or die("Ошибка открытия файла для чтения!");
if (!$file) {
    echo ("Не был найден файл для чтения данных!");
} else { ?>
    <div>Данные из файла: </div>
    <?php
    while (!feof($file)) {
        echo fgets($file); ?>
        <br />
        <?php
    }
    fclose($file);
}