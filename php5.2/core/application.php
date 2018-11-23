<?php
require_once 'config.php';
require_once '../php52/controller/controllerTodo.php';
require_once '../php52/model/modelTodo.php';
require_once '../php52/model/modelRegistration.php';
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

// Подключаем Twig
require_once './vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./template');
$twig = new Twig_Environment($loader, array(
    'cache' => './cache',
    'auto_reload' => true,
));
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('post', $_POST);
$twig->addGlobal('button', General::button());
$twig->addGlobal('description', General::description());
$twig->addGlobal('sorting', Todo::sorting());
$twig->addGlobal('assigned', Todo::assigned());
$twig->addGlobal('users', Register::users());
$twig->addGlobal('author', Todo::author());



?>