<?php
require_once '../php52/controller/controllerTodo.php';
require_once '../php52/controller/controllerRegistration.php';

if (!empty($_GET)) {
    if (!empty($_GET['id']) && !empty($_GET['action'])) {
        $id = 'id';
        $action = 'action';
    } else {
        $id = $_GET['id'];
        $action = $_GET['action'];
    }
    if ($id == 'id') {
        $controllerTodo = new General();
        if ($action == 'action' && $_GET['action'] == 'edit') {
            $controllerTodo->edit();
        }
        if ($action == 'action' && $_GET['action'] == 'done') {
            $controllerTodo->done();
        }
        if ($action == 'action' && $_GET['action'] == 'delete') {
            $controllerTodo->delete();
        }
    }
}

if (!empty($_POST['save']) && $_POST['save'] == 'Добавить' && !empty($_SESSION['id'])) {
    $controllerTodo = new General();
    $controllerTodo->add();
}

if (!empty($_POST['assigned_user_id']) && !empty($_POST['assign']) && !empty($_POST['number'])) {
    $controllerTodo = new General();
    $controllerTodo->select();
}

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    if (!empty($_POST['sign_in']) || !empty($_POST['register'])) {
        $login = 'login';
        $password = 'password';
        $sign = 'sign_in';
        $register = 'register';
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];
    }
    if (!empty($_POST['sign_in'])) {
        $controllerRegister = new Registration();
        if ($login == 'login' && $password == 'password' && $sign == 'sign_in') {
            $controllerRegister->login();
        }
    }
}

$controllerRegister = new Registration();
$controllerRegister->isNotAuthorized();

