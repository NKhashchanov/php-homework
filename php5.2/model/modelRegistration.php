<?php
require_once '../php52/core/application.php';
require_once '../php52/controller/controllerRegistration.php';


class Register
{
// Логин пользователя
    function login($params)
    {
        global $pdo;
        $login = $params['login'];
        $password = $params['password'];
        $stmt = $pdo->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        foreach ($stmt->fetchAll() as $data) {
             $_SESSION['login'] = $data['login'];
             $_SESSION['id'] = $data['id'];
        }
        header('Location: ../php52/index.php');
    }

// Регистрация пользователя
    function registerUser($params)
    {
        global $pdo;
        $login = $params['login'];
        $password = $params['password'];
        $stmt = $pdo->prepare('INSERT INTO user (login, password) VALUES(?, ?)');
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $password;
        header('Location: ../php52/index.php');
    }

// Получаем массив с пользователями
    static function users()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM user');
        $data = $stmt->fetchAll();
        return $data;
    }
}

?>