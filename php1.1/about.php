<?php
$name = 'Николай';
$age = '34';
$email = 'nikolay-rg@mail.ru';
$city = 'Москва';
$info = 'здесь должен быть текст обо мне';
if ($name){ ?>
<h1>Страница пользователя <?=$name?></h1>
<table>
    <tr>
        <td>Имя</td>
        <td><?=$name?></td>
    </tr>
    <tr>
        <td>Возраст</td>
        <td><?=$age?></td>
    </tr>
    <tr>
        <td>Почта</td>
        <td><a href=mailto:<?=$email?>><?=$email?></a></td>
    </tr>
    <tr>
        <td>Город</td>
        <td><?=$city?></td>
    </tr>
    <tr>
        <td>О себе</td>
        <td><?=$info?></td>
    </tr>
</table>
<?php } else { ?>
<h2>Пользователь не найден</h2>
<?php } ?>
