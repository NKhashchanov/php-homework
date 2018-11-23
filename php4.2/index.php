<?php
require_once 'application.php';
add();
action();
?>

<style>
    table {
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }

    table th {
        background: #eee;
    }
</style>

<h1>Список дел на сегодня</h1>
<div style="float: left">
    <form method="POST">
        <input type="text" name="description" required placeholder="Описание задачи" value="<?php description() ?>" />
        <input type="submit" name="save" value="<?php button() ?>" />
    </form>
</div>
<div style="float: left; margin-left: 20px;">
    <form method="POST">
        <label for="sort">Сортировать по:</label>
        <select name="sort_by">
            <option value="date_created">Дате добавления</option>
            <option value="is_done">Статусу</option>
            <option value="description">Описанию</option>
        </select>
        <input type="submit" name="sort" value="Отсортировать" />
    </form>
</div>
<div style="clear: both"></div>

<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
    </tr>

        <?php foreach (sorting() as $row) {
            echo '<tr>';
            echo '    <td>' . $row['description'] . '</td>';
            echo '    <td>' . $row['date_added'] . '</td>';
            if ($row['is_done'] == 0) {
                echo '    <td> <span style="color: orange;">В процессе</span> </td>';
            } else {
                echo '    <td> <span style="color: green;">Выполнено</span> </td>';
            }
            echo '    <td>';
            echo '  <a href="?id='.$row['id'].'&action=edit">Изменить</a>';
            echo '  <a href="?id='.$row['id'].'&action=done">Выполнить</a>';
            echo '  <a href="?id='.$row['id'].'&action=delete">Удалить</a>';
            echo '    </td>';
            echo '</tr>';
        }?>
</table>
