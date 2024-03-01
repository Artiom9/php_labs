<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cats Galery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        nav {
            background-color: #555;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        nav a:hover {
            background-color: #777;
        }

        section {
            padding: 20px;
            text-align: center;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav>
        <a href="#">About Cats</a>
        <a href="#">News</a>
        <a href="#">Contacts</a>
    </nav>

    <header>
        <h1>#cats</h1>
        <h2>Explore a world of cats</h2>
    </header>

    <section>
        <?php
        $dir = 'image/';
        $files = scandir($dir);
        if ($files === false) {
            return;
        }

        for ($i = 0; $i < count($files); ++$i) {
            // Пропускаем текущий каталог и родительский
            if (($files[$i] != ".") && ($files[$i] != "..")) {
                // Получаем путь к изображению
                $path = $dir . $files[$i];
                echo '<img src="' . $path . '" alt="Cat ' . ($i + 1) . '" height="400">';
            }
        }
        ?>
    </section>

    <footer>
        USM &copy; 2024
    </footer>
</body>

</html>