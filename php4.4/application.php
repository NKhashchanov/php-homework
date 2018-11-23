<?php
require_once 'connect.php';
session_start();

$pdo = new PDO($link, $user, $password, $options);

$sql = "CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`description` text NOT NULL,
`is_done` tinyint(4) NOT NULL DEFAULT '0',
`date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
`user_id` int(11) NOT NULL,
`assigned_user_id` int(11) DEFAULT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql);

$sql2 = "CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`login` varchar(50) NOT NULL,
`password` varchar(255) NOT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql2);

//Создадим тестовую таблицу, над которой будем издеваться, другие трогать нельзя!!!
$sql3 = "CREATE TABLE IF NOT EXISTS `test` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`field_number_one` varchar(50) NOT NULL,
`another_field` varchar(255) NOT NULL,
`number_field` int(11) NOT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql3);

// Получим список таблиц
function listTables() {
    global $pdo;
    global $database;
    $stmt = $pdo->query('SHOW TABLES FROM '.$database.'');
    $data = $stmt->fetchAll();
    return $data;
}

// Получим структуру таблицы
function columns() {
    global $pdo;
    $stmt = $pdo->prepare('SHOW COLUMNS FROM '. $_GET['name'] .'');
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

// Список таблиц БД
function tables() {
    foreach (listTables() as $value) {
        foreach ($value as $val) {
            $tables[] = $val;
        }
    }
    return $tables;
}

// Проверка на наличие таблицы в БД
function tableExist() {
    if (!in_array($_GET['name'], tables())) {
        http_response_code(404);
        echo 'Cтраница не найдена!';
        exit(1);
    }
}
// Добавление поля
function add() {
    if (!empty($_POST['add'])) {
        global $pdo;
        $table = $_GET['name'];
        $field = $_POST['field'];
        $type = $_POST['type'];
        $stmt = $pdo->prepare('ALTER TABLE '. $table .' ADD COLUMN '. $field .' '. $type .' ');
        $stmt->execute();
    }
}

// Удаление поля
function deleteField() {
    if (!empty($_GET['field'])) {
        global $pdo;
        $field = htmlspecialchars($_GET['field']);
        $name = htmlspecialchars($_GET['name']);
        if ($_GET['action'] == 'delete') {
            $stmt = $pdo->prepare('ALTER TABLE '.$name.' DROP COLUMN '. $field .';');
            $stmt->execute();
        }
    }
}

// Редактирование поля, смена имени и типа
function editField() {
    if (!empty($_POST['edit'])) {
        global $pdo;
        $table = htmlspecialchars($_GET['name']);
        $oldField = htmlspecialchars($_GET['field']);
        $newField = (string)$_POST['field'];
        $type = $_POST['type'];
        $stmt = $pdo->prepare('ALTER TABLE '. $table .' CHANGE '. $oldField .' '. $newField .' '. $type .';');
        $stmt->execute();
    }
}

// Текст имени поля при изменении
function fieldText() {
    if (!empty($_GET['action']) && !empty($_GET['field'] && $_GET['action'] == 'edit')) {
        foreach (columns() as $value) {
            if ($value['Field'] == $_GET['field']) {
                echo $value['Field'];
            }
        }
    }
}

// Текст типа поля при изменении
function typeText() {
    if (!empty($_GET['action']) && !empty($_GET['field'] && $_GET['action'] == 'edit')) {
        foreach (columns() as $value) {
            if ($value['Field'] == $_GET['field']) {
                echo $value['Type'];
            }
        }
    }
}

// Редирект
function redirect($page) {
    header("Location: $page.php");
    die;
}
?>