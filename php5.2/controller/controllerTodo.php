<?php
require_once '../php52/core/application.php';
require_once '../php52/model/modelTodo.php';

Class  General
{
// Смена значения кнопки
    static function button()
    {
        if (!empty($_GET) && $_GET['action'] == 'edit') {
            return 'Сохранить';
        } else {
            return 'Добавить';
        }
    }

// Отображение описания в форме описания
    static function description()
    {
        if (!empty($_GET) && !empty($_GET['id']) && $_GET['action'] == 'edit') {
            foreach (Todo::sorting() as $row) {
                if ($row['id'] == $_GET['id']) {
                    return $row['description'];
                }
            }
        }
    }

// Функция выполнения
    function done()
    {
        $todo = new Todo();
        if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'done') {
            $data = [];
            $data['id'] = (int)$_GET['id'];
            $data['done'] = 1;
            $result = $todo->done($data);
            if ($result) {
                header('Location: ../php52/');
            }
        }
    }

// Функция редактирования
    function edit()
    {
        $todo = new Todo();
        if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'edit' && !empty($_POST['description'])) {
            $data = [];
            $data['id'] = (int)$_GET['id'];
            $data['description'] = $_POST['description'];
            $result = $todo->edit($data);
            if ($result) {
                header('Location: ../php52/');
            }
        }
    }

// Функция удаления
    function delete()
    {
        $todo = new Todo();
        if (!empty($_GET['id']) && !empty($_GET['action']) && $_GET['action'] == 'delete') {
            $data = [];
            $data['id'] = (int)$_GET['id'];
            $result = $todo->delete($data);
            if ($result) {
                header('Location: ../php52/');
            }
        }
    }

// Выбор ответственного
    function select() {
        $todo = new Todo();
        foreach (Todo::sorting() as $key => $row) {
            if ($row['user_id'] == $_SESSION['id']) {
                if (!empty($_POST['assigned_user_id']) && $_POST['number'] == $key) {
                    if (!empty($_POST['assign'])) {
                        $data = [];
                        $data['id'] = (int)$row['id'];
                        $data['assigned_user_id'] = $_POST['assigned_user_id'];
                        $result = $todo->select($data);
                        if ($result) {
                            header('Location: ../php52/');
                        }
                    }
                }
            }
        }
    }

// Добавление задания
    function add()
    {
        $todo = new Todo();
        if (!empty($_POST['save']) && $_POST['save'] == 'Добавить' && !empty($_SESSION['id'])) {
            $data = [];
            $data['description'] = $_POST['description'];
            $data['userID'] = $_SESSION['id'];
            $data['assigned'] = $_SESSION['id'];
            $result = $todo->add($data);
            if ($result) {
                header('Location: ../php52/');
            }
        }
    }
}

