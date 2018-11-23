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
// Добавление задания
function add() {
    if (!empty($_POST['save']) && $_POST['save'] == 'Добавить' && !empty($_SESSION['id'])) {
        global $pdo;
        $description = $_POST['description'];
        $userID = $_SESSION['id'];
        $assigned = $_SESSION['id'];
        $stmt = $pdo->prepare('INSERT INTO tasks (description, user_id, assigned_user_id) VALUES(?, ?, ?)');
        $stmt->bindParam(1, $description);
        $stmt->bindParam(2, $userID);
        $stmt->bindParam(3, $assigned);
        $stmt->execute();
    }
}
// Получим имя назначенного пользователя
function assigned() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM tasks LEFT JOIN user ON tasks.assigned_user_id = user.id');
    $data = $stmt->fetchAll();
    return $data;
}
// Получим имя автора
function author() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM tasks LEFT JOIN user ON tasks.user_id = user.id');
    $data = $stmt->fetchAll();
    return $data;
}
// Функция которая выполняет  редактирование, удаление, выполнение
function action() {
    if (!empty($_GET)) {
        global $pdo;
        $id = (int)$_GET['id'];
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
// Смена значения кнопки
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
// Сортировка
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
// Расширяем функционал
// Если не авторизован даем ссылку на регистрацию, в противном случае выдаем таблицу
function isNotAuthorized() {
    if (empty($_SESSION['login'])) {
        echo '<a href = "registration.php"> Войдите на сайт </a>';
    } else {
        include_once 'table.php';
        echo '<br><a href="logout.php">Выход</a>';
    }
}
// Логин пользователя
function login()
{
    global $pdo;
    if (!empty($_POST['sign_in'])) {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            if ($login == '') {
                unset($login);
            }
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            if ($password == '') {
                unset($password);
            }
        }

        if (count(array_filter(users(), function ($value) {
                return $value["login"] == $_POST['login'];
            })) == 0)
        {
            echo 'Пользователь не найден';
        } else {
            $login = htmlspecialchars($login);
            $password = htmlspecialchars($password);
            $stmt = $pdo->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            foreach ($stmt->fetchAll() as $data) {
                $_SESSION['login'] = $data['login'];
                $_SESSION['id'] = $data['id'];
            }
            redirect('index');
        }
    }
}
// Регистрация пользователя
function register() {
    global $pdo;
    if (!empty($_POST['register'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare('INSERT INTO user (login, password) VALUES(?, ?)');
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        redirect('index');
    }
}
// Получаем массив с пользователями
function users() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM user');
    $data = $stmt->fetchAll();
    return $data;
}
// Редирект
function redirect($page) {
    header("Location: $page.php");
    die;
}
// Логаут
function logout() {
    session_destroy();
    header('Location: index.php');
}
// Выбор ответственного
function select() {
    foreach (sorting() as $key => $row) {
        if (!empty($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
            if (!empty($_POST['assigned_user_id']) && $_POST['number'] == $key) {
                global $pdo;
                if (!empty($_POST['assign'])) {
                    $assign = $_POST['assigned_user_id'];
                    $id = $row['id'];
                    $stmt = $pdo->prepare('UPDATE tasks SET assigned_user_id = :assigned_user_id WHERE id = :id');
                    $stmt->bindParam(':assigned_user_id', $assign);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                }
            }
        }
    }
}
?>