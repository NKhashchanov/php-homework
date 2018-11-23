<?php
require_once '../php52/core/application.php';

class Todo
{
// Добавление задания
    static function add($params)
    {
        global $pdo;
        $description = $params['description'];
        $userID = $params['userID'];
        $assigned = $params['assigned'];
        $stmt = $pdo->prepare('INSERT INTO tasks (description, user_id, assigned_user_id) VALUES(?, ?, ?)');
        $stmt->bindParam(1, $description);
        $stmt->bindParam(2, $userID);
        $stmt->bindParam(3, $assigned);
        return $stmt->execute();
    }

// Получим имя назначенного пользователя
    static public function assigned()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM tasks LEFT JOIN user ON tasks.assigned_user_id = user.id');
        $data = $stmt->fetchAll();
        return $data;
    }

// Получим имя автора
    static function author()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM tasks LEFT JOIN user ON tasks.user_id = user.id');
        $data = $stmt->fetchAll();
        return $data;
    }

// Функция выполнения
    function done($params)
    {
        global $pdo;
        $done = $params['done'];
        $id = $params['id'];
        $stmt = $pdo->prepare('UPDATE tasks SET is_done = :is_done WHERE id = :id');
        $stmt->bindParam(':is_done', $done);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

// Функция редактирования
    function edit($params)
    {
        global $pdo;
        $id = $params['id'];
        $edit = $params['description'];
        $stmt = $pdo->prepare('UPDATE tasks SET description = :description WHERE id = :id');
        $stmt->bindParam(':description', $edit);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

// Функция удаления
    function delete($params)
    {
        global $pdo;
        $id = $params['id'];
        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

// Сортировка
    static function sorting()
    {
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

// Выбор ответственного
    function select($params)
    {
        global $pdo;
        $assign = $params['assigned_user_id'];
        $id = $params['id'];
        $stmt = $pdo->prepare('UPDATE tasks SET assigned_user_id = :assigned_user_id WHERE id = :id');
        $stmt->bindParam(':assigned_user_id', $assign);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}