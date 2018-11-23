<?php
require_once 'application.php';

echo '<br><h2>Список таблиц в Базе Данных</h2><br>';

foreach (listTables() as $value) {
    foreach ($value as $val) {
        echo '<li><a href="table.php?name=' . $val . '">' . $val . '</a></li><br>';
    }
}





