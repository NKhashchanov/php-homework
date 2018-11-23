<?php
require 'application.php';
login();
if (!empty($_POST['register'])) {
    if (count(array_filter(users(), function ($value) {
            return $value["login"] == $_POST['login'];
        })) == 1)
    {
        echo 'Такой пользователь уже существует в базе данных.';
    } else {
        register();
    }
} else {
    echo '<p>Введите данные для регистрации или войдите, если уже регистрировались:</p>';
}


?>


<form method="POST">
    <input type="text" name="login" placeholder="Логин" />
    <input type="password" name="password" placeholder="Пароль" />
    <input type="submit" name="sign_in" value="Вход" />
    <input type="submit" name="register" value="Регистрация" />
</form>
