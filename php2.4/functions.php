<?php
session_start();

// Авторизация
function login($login, $password) {
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}
function isAuthorized() {
    return !empty($_SESSION['user']);
}
function isAdmin() {
    return isAuthorized() && $_SESSION['user']['is_admin'];
}
function guest($guestName){
    $_SESSION['guestName'] = $_POST['guestName'];
}
// Получаем список пользователей
function getUsers() {
    $fileData = file_get_contents(__DIR__ . '/data/login.json');
    $users = json_decode($fileData, true);
    if (empty($users)) {
        return [];
    }
    return $users;
}

// Получаем пользователя по логину
function getUser($login) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}

// Логаут
function logout() {
    session_destroy();
    header('Location: index.php');
}

// Редирект
function redirect($page) {
    header("Location: $page.php");
    die;
}

// Регистрация
function registration($name, $newLogin, $newPassword) {
    $file = file_get_contents(__DIR__ . '/data/login.json');
    $newUser = json_decode($file,TRUE);
    unset($file);
    $is_admin = 0;

    $newUser[] = array('login'=>$newLogin, 'password' => $newPassword, 'user'=>$name, 'is_admin' => $is_admin);

    file_put_contents(__DIR__ . '/data/login.json',json_encode($newUser));
    unset($newUser);
    redirect('list');
}

// Удаление тестов
function deleteTest ($test){
    $oldTest = __DIR__ . '/tests/' . $_POST['tests'];
    unlink($oldTest);
    redirect('list');
}
