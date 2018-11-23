<?php
require_once 'application.php';
select();
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
<h1>Здравствуйте, <?php echo $_SESSION['login'];?>! Вот ваш список дел:</h1>
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
        <th>Ответственный</th>
        <th>Автор</th>
        <th>Закрепить задачу за пользователем</th>
    </tr>

    <?php foreach (sorting() as $key => $row) : ?>
        <?php if ($row['user_id'] == $_SESSION['id']) : ?>
            <tr>
            <td><?= $row['description'] ?></td>
            <td><?=  $row['date_added'] ?></td>
             <?php if ($row['is_done'] == 0) {
                echo '    <td> <span style="color: orange;">В процессе</span> </td>';
            } else {
                echo '    <td> <span style="color: green;">Выполнено</span> </td>';
            } ?>
            <td>
            <a href="?id=<?= $row['id'] ?>&action=edit">Изменить</a>
            <a href="?id=<?= $row['id'] ?>&action=done">Выполнить</a>
            <a href="?id=<?= $row['id'] ?>&action=delete">Удалить</a>
            </td>
            <?php if ($row['assigned_user_id'] == $_SESSION['id']) {
                echo '    <td>Вы</td>';
            } else {
                foreach (assigned() as $value) {
                    if ($row['assigned_user_id'] == $value['id']) {
                        $x = $value['login'];
                    }
                }
                echo '    <td>' . $x . '</td>';
            } ?>
            <td>Вы</td>
            <td>
            <form method="POST">
                <input type="hidden" name="number" value="<?= $key ?>">
                <select id = "assigned_user_id" name="assigned_user_id">
                    <?php foreach (users() as $user) {
                        echo '<option value="' . $user['id'] . '">' . $user['login'] . '</option>';
                    } ?>
                </select>
                <input type="submit" name="assign" value="Переложить ответственность" />
            </form>
            </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>

<br><p><strong>Также, посмотрите, что от Вас требуют другие люди:</strong></p><br>

<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
        <th>Ответственный</th>
        <th>Автор</th>
    </tr>
    <?php foreach (sorting() as $row) :?>
        <?php if ($row['assigned_user_id'] == $_SESSION['id'] && $row['user_id'] != $_SESSION['id']) : ?>
            <tr>
            <td><?= $row['description'] ?></td>
            <td><?= $row['date_added'] ?></td>
            <?php if ($row['is_done'] == 0) {
                echo '<td> <span style="color: orange;">В процессе</span> </td>';
             } else {
                echo '<td> <span style="color: green;">Выполнено</span> </td>';
             } ?>
            <td>
                <a href="?id=<?= $row['id'] ?>&action=edit">Изменить</a>
                <a href="?id=<?= $row['id'] ?>&action=done">Выполнить</a>
                <a href="?id=<?= $row['id'] ?>&action=delete">Удалить</a>
            </td>
            <? if ($row['assigned_user_id'] == $_SESSION['id']) { ?>
                <td>Вы</td>
            <? } ?>
            <?php foreach (author() as $value) {
                if ($row['user_id'] == $value['id']) {
                    $x = $value['login'];
                }
            } ?>
            <td><?= $x ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>