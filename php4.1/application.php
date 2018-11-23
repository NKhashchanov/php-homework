<?php
require_once 'connect.php';
session_start();

$pdo = new PDO($link, $user, $password, $options);

function books() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM books');
    $data = $stmt->fetchAll();
    return $data;
}

function Search() {
    if (!empty($_GET)) {
        global $pdo;
        $name = htmlspecialchars($_GET["name"]);
        $name = "%$name%";
        $author = htmlspecialchars($_GET["author"]);
        $author = "%$author%";
        $isbn = htmlspecialchars($_GET["isbn"]);
        $isbn = "%$isbn%";
        $stmt = $pdo->prepare('SELECT * FROM books WHERE name LIKE ? AND author LIKE ? AND isbn LIKE ?');
        $stmt->bindValue(1, '%'.$name.'%', PDO::PARAM_STR);
        $stmt->bindValue(2, '%'.$author.'%', PDO::PARAM_STR);
        $stmt->bindValue(3, '%'.$isbn.'%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}

function name() {
    if (!empty($_GET['name'])) {
        echo $_GET["name"];
    }
}
function isbn() {
    if (!empty($_GET['isbn'])) {
        echo $_GET["isbn"];
    }
}
function author() {
    if (!empty($_GET['author'])) {
        echo $_GET["author"];
    }
}
