<?php
require_once 'application.php';
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
<h1>Библиотека успешного человека</h1>

<form method="GET">
    <input type="text" name="isbn" placeholder="ISBN" value="<?php echo isbn();?>">
    <input type="text" name="name" placeholder="Название книги" value="<?php echo name();?>" >
    <input type="text" name="author" placeholder="Автор книги" value="<?php echo author();?>">
    <input type="submit" value="Поиск">
</form>
<table>
    <thead>
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>ISBN</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if (isset($_GET['name']) || isset($_GET['author']) || isset($_GET['isbn'])) {
            if (count(search()) >= 1) {
                foreach (search() as $row) {
                    echo '<tr>';
                    echo '    <td>' . $row['name'] . '</td>';
                    echo '    <td>' . $row['author'] . '</td>';
                    echo '    <td>' . $row['year'] . '</td>';
                    echo '    <td>' . $row['isbn'] . '</td>';
                    echo '    <td>' . $row['genre'] . '</td>';
                    echo '<tr>';
                }
            } else {
                echo '<h4>По Вашему запросу ничего не найдено</h4>';
            }
        } else {
            foreach (books() as $row) {
                echo '<tr>';
                echo '    <td>' . $row['name'] . '</td>';
                echo '    <td>' . $row['author'] . '</td>';
                echo '    <td>' . $row['year'] . '</td>';
                echo '    <td>' . $row['isbn'] . '</td>';
                echo '    <td>' . $row['genre'] . '</td>';
                echo '<tr>';
        }
            }?>
        </tr>
    </tbody>
</table>
