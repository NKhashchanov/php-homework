<?php
require_once 'connect.php';
session_start();

$pdo = new PDO($link, $user, $password, $options);

$sql = "CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`description` text NOT NULL,
`is_done` tinyint(4) NOT NULL DEFAULT '0',
`date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$pdo->exec($sql);

function add() {
    if (!empty($_POST['save']) && $_POST['save'] == 'Добавить') {
        global $pdo;
        $description = $_POST['description'];
        $stmt = $pdo->prepare('INSERT INTO tasks (description) VALUES(?)');
        $stmt->bindParam(1, $description);
        $stmt->execute();
    }
}

function action() {
    if (!empty($_GET)) {
        global $pdo;
        $id = $_GET['id'];
        if ($_GET['action'] == 'edit' && !empty($_POST['description'])) {
            $edit = $_POST['description'];
            $stmt = $pdo->prepare('UPDATE tasks SET description = :description WHERE id = :id');
            $stmt->bindParam(':description', $edit);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else if ($_GET['action'] == 'done') {
            $done = 1;
            $stmt = $pdo->prepare('UPDATE tasks SET is_done = :is_done WHERE id = :id');
            $stmt->bindParam(':is_done', $done);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } else if ($_GET['action'] == 'delete') {
            $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
}

function button() {
    if (!empty($_GET) && $_GET['action'] == 'edit') {
        echo 'Сохранить';
    } else {
        echo 'Добавить';
    }
}

function description() {
    if (!empty($_GET) && !empty($_GET['id'] && $_GET['action'] == 'edit')) {
        foreach (sorting() as $row) {
            if ($row['id'] == $_GET['id']) {
                echo $row['description'];
            }
        }
    }
}

function sorting() {
    if (!empty($_POST['sort_by'])) {
        if ($_POST['sort_by'] == 'description') {
            global $pdo;
            $stmt = $pdo->query('SELECT * FROM tasks ORDER BY description');
            $data = $stmt->fetchAll();
            return $data;
        } else if ($_POST['sort_by'] == 'is_done') {
            global $pdo;
            $stmt = $pdo->query('SELECT * FROM tasks ORDER BY is_done');
            $data = $stmt->fetchAll();
            return $data;
        } else if ($_POST['sort_by'] == 'date_created') {
            global $pdo;
            $stmt = $pdo->query('SELECT * FROM tasks ORDER BY date_added');
            $data = $stmt->fetchAll();
            return $data;
        }
    } else {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM tasks ORDER BY date_added');
        $data = $stmt->fetchAll();
        return $data;
    }
}

?>
