<?php
require_once '../php52/core/application.php';
require_once '../php52/model/modelRegistration.php';

Class Registration
{
// Редирект
    static function redirect($page)
    {
        header("Location: $page.php");
        die;
    }

// Логаут
    function logout()
    {
        session_destroy();
        header('Location: ../php52/index.php');
    }

// Если не авторизован даем ссылку на регистрацию, в противном случае выдаем таблицу
    function isNotAuthorized()
    {
        global $twig;
        if (empty($_SESSION['login'])) {
            echo '<a href = "../php52/registration.php"> Войдите на сайт </a>';
        } else {
            $template = $twig->loadTemplate('templateTable.twig');
            echo $template->render(array('the' => 'variables', 'go' => 'here'));
        }
    }

// Логин пользователя
    function login()
    {
        $user = new Register();
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

        if (!empty($_POST['sign_in'])) {
            if (count(array_filter(Register::users(), function ($value) {
                    return $value["login"] == $_POST['login'];
                })) == 0) {
                echo 'Пользователь не найден';
            } else {
                $data = [];
                if (!empty($_POST['login'])) {
                    $data['login'] = $_POST['login'];
                }
                if (!empty($_POST['password'])) {
                    $data['password'] = $_POST['password'];
                }
                $result = $user->login($data);
                if ($result) {
                    header('Location: ../php52/index.php');
                }
            }
        }
    }

// Регистрация пользователя
    function registerUser()
    {
        $user = new Register();
        if (!empty($_POST['register'])) {
            if (count(array_filter(Register::users(), function ($value) {
                    return $value["login"] == $_POST['login'];
                })) == 1) {
                echo 'Такой пользователь уже существует в базе данных.';
            } else {
                $data = [];
                if (!empty($_POST['login'])) {
                    $data['login'] = $_POST['login'];
                }
                if (!empty($_POST['password'])) {
                    $data['password'] = $_POST['password'];
                }
                $result = $user->registerUser($data);
                if ($result) {
                    header('Location: ../php52/index.php');
                }
            }
        }
    }
}

