<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <fieldset>
        <legend>Оставьте отзыв!</legend>
        <label>Имя:
            <input type="text" name="name" />
        </label>
        <label>Возраст:
            <input type="numer" name="age" />
        </label>
        <label>Пол:
            <select name="sex">
                <option>М</option>
                <option>Ж</option>
            </select>
        </label>

        <input type="submit" value="Отправить" />
    </fieldset>
</form>
<?php
if (!empty($_POST)) {
    if ((int)$_POST['age'] > 18)
        echo '<p>Добро пожаловать ' . $_POST["name"] . '.</p>';
    else
        echo '<p>Вам ещё нет 18, ' . $_POST["name"] . '.</p>';
}
