<?php
require_once "modules/save.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Резервирование</title>
    <link rel="icon" href="images/icon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <h1>Резервирование места</h1>
        <form action="index.php" autocomplete="off" method="post">
            <div class="row">
                <div class="col">
                    <label>Фамилия*</label>
                    <input type="text" placeholder="Фамилия" name="name" class="form-control <?= !empty($err['name']) ? 'is-invalid' : '' ?>" value="<?= $name ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["name"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Имя*</label>
                    <input type="text" placeholder="Имя" name="surname" class="form-control <?= !empty($err['surname']) ? 'is-invalid' : '' ?>" value="<?= $surname ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["surname"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Номер телефона*</label>
                    <input type="tel" placeholder="Номер телефона" name="phone" class="form-control <?= !empty($err['phone']) ? 'is-invalid' : '' ?>" value="<?= $phone ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["phone"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Email*</label>
                    <input type="email" placeholder="Email" name="email" class="form-control <?= !empty($err['email']) ? 'is-invalid' : '' ?>" value="<?= $email ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["email"] ?? '' ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Дата прибытия*</label>
                    <input type="date" name="int_date" class="form-control <?= !empty($err['int_date']) ? 'is-invalid' : '' ?>" value="<?= $int_date ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["int_date"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Дата отбытия*</label>
                    <input type="date" name="exit_date" class="form-control <?= !empty($err['exit_date']) ? 'is-invalid' : '' ?>" class="form-control" value="<?= $exit_date ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["exit_date"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Количество человек*</label>
                    <input type="number" value="1" min="1" max="5" name="nmbr" class="form-control <?= !empty($err['nmbr']) ? 'is-invalid' : '' ?>" value="<?= $nmbr ?? '' ?>" required />
                    <div class="invalid-feedback">
                        <?= $err["nmbr"] ?? '' ?>
                    </div>
                </div>
                <div class="col">
                    <label>Тип номера*</label>
                    <select name="type" class="form-select <?= !empty($err['type']) ? 'is-invalid' : '' ?>" required>
                        <option value="lux" <?php if (isset($type) && $type == 'lux') echo 'selected'; ?>>Lux</option>
                        <option value="econom" <?php if (isset($type) && $type == 'econom') echo 'selected'; ?>>Econom</option>
                        <option value="apartament" <?php if (isset($type) && $type == 'apartament') echo 'selected'; ?>>Apartament</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $err["type"] ?? '' ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Комментарии</label>
                    <textarea placeholder="Введи..." rows="5" class="form-control <?= !empty($err['obs']) ? 'is-invalid' : '' ?>" name="obs"><?= $obs ?? '' ?></textarea>
                    <div class="invalid-feedback">
                        <?= $err["obs"] ?? '' ?>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col">
                    <input type="submit" value="Отправить" class="btn btn-primary" name="ok" />
                </div>
            </div>
        </form>
    </div>
</body>

</html>