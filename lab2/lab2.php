<table border="1">
    <caption>
        График работы докторов, каб. 333
    </caption>
    <tr>
        <th>П.н.</th>
        <th>Фамилия, имя</th>
        <th>График</th>
    </tr>
    <tr>
        <td>1.</td>
        <td>Аксенти Елена</td>
        <td>
            <?php
            $day = date('w');
            if ($day == 1 || $day == 3 || $day == 5)
                echo '8:00 - 12:00';
            else
                echo 'Нерабочий день';
            ?>
        </td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Петрова Мария</td>
        <td>
            <?php
            $day = date('w');
            if ($day == 2 || $day == 4 || $day == 6)
                echo '12:00 - 16:00';
            else
                echo 'Нерабочий день';
            ?>
        </td>
    </tr>
</table>