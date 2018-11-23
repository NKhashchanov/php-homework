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
<?php
require_once 'application.php';
tableExist();
deleteField();
add();
editField();

echo '<br><a href = "index.php">Вернуться к списку тестов</a><br>';
echo <<<HTML
<br><h2>Данные таблицы {$_GET['name']}</h2><br>
<table>
    <thead>
        <tr>
            <th>Field</th>
            <th>Type</th>
            <th>Null</th>
            <th>Key</th>
            <th>Default</th>
            <th>Extra</th>
            <th>Удалить</th>
            <th>Изменить имя поля и тип</th>
        </tr>
    </thead>
    <tbody>
HTML;
   foreach (columns() as $value) { 
        echo '<tr >';
        echo '  <td >' .$value['Field']. '</td >';
        echo '  <td >' .$value['Type']. '</td >';
        echo '  <td >' .$value['Null']. '</td >';
        echo '  <td >' .$value['Key']. '</td >';
        echo '  <td >' .$value['Default']. '</td >';
        echo '  <td >' .$value['Extra']. '</td >';
        echo '    <td>';
        if ($_GET['name'] !== 'tasks' && $_GET['name'] !== 'user') {  // Что бы не затрагивать таблицы других домашних заданий
            echo '  <a href = "?field=' . $value['Field'] .'&action=delete&name=' . $_GET['name'] .'">Удалить</a>';
        }
        echo '    </td>';
       echo '    <td>';
       if ($_GET['name'] !== 'tasks' && $_GET['name'] !== 'user') {  // Что бы не затрагивать таблицы других домашних заданий
           echo '  <a href = "?field=' . $value['Field'] .'&action=edit&name=' . $_GET['name'] .'">Изменить</a>';
       }
       echo '    </td>';
        echo '</tr >';
   }
echo '</tbody>';
echo '</table><br>';
include 'add.php';






