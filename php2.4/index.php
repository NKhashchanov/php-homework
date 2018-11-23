<?php
require_once __DIR__ . '/functions.php';
if (isAuthorized()) {
    redirect('list');
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_POST) === true) {
    if (!empty($_POST['login']) === true && !empty($_POST['password']) === true) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (login($login, $password)) {
            redirect('list');
        } else {
            $errors[] = 'Логин или пароль неверные';
        }
    } elseif (!empty($_POST['guestName']) === true) {
        $guestName = $_POST['guestName'];
        guest($guestName);
        redirect('list');
    } elseif (!empty($_POST['newName']) === true && !empty($_POST['newLogin']) === true && !empty($_POST['newPassword']) === true) {
        $name = $_POST['newName'];
        $newLogin = $_POST['newLogin'];
        $newPassword = $_POST['newPassword'];
        (registration($name, $newLogin, $newPassword));
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Авторизация</title>
</head>
<body>
<section id="login">
                <div class="form-wrap">
                    <div style = 'text-align: center'><span> Авторизация </span></div>
                    <form method="POST" id="login-form" action="">
                        <div class="form-group">
                            <label for="lg" class="sr-only">Логин</label>
                            <input type="text" placeholder="Логин" name="login" id="lg" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Пароль</label>
                            <input type="password"  placeholder="Пароль" name="password" id="key" class="form-control">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Войти">
                    </form>

                    <hr>
                </div>
</section>
<section id = 'guest'>
    <div>
        <form method="POST" id="guest-form" action="">
        <div class="form-group">
            <div style = 'text-align: center'><span> Если вы не хотите регистрироваться, введите Ваше имя </span></div>
            <input type="text" placeholder="Имя" name="guestName" id="lg" class="form-control">
        </div>
        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Войти">
        </form>
    </div>
</section>
<section id = 'registration'>
    <div style="margin-top: 20px">
        <form method="POST" id="registration-form" action="">
            <div class="form-group">
                <div style = 'text-align: center'><span> Регистрация </span></div>
                <input type="text" required placeholder="Имя" name="newName" id="lg" class="form-control">
                <input type="text" required placeholder="Логин" name="newLogin" id="lg" class="form-control">
                <input type="text" required placeholder="Пароль" name="newPassword" id="lg" class="form-control">
            </div>
            <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Зарегистрироваться">
        </form>
    </div>
</section>
</body>
</html>