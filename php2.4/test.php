<?php
require_once __DIR__ . '/functions.php';
// Проверим на не пустой GET
if ($_GET["name"] == null) die('<a href = "./list.php">Выберите тест</a>');
// Проверим, что запрос соответствует тесту на сервере
$filesDir = "./tests";
$filesList = scandir($filesDir);
if (in_array($_GET["name"], $filesList)) {
    } else {
    http_response_code(404);
    echo 'Cтраница не найдена!';
    exit(1);
}
//Прочитаем JSON тест
$fileName = $_GET["name"];
$json = file_get_contents("./tests/$fileName");
$jsonData = json_decode($json, true);

// Выведем тест
echo 'Название теста: ' . $jsonData['label'] . '<br>';
echo '<form method="POST" action="">';
    foreach ($jsonData as $key => $question) {
        if ($key !== 'label') {
        echo $question['q'] . '<br>';
            for ($i = 1; $i < count($jsonData) - 1; $i++) {
                echo '<input required type="radio" name=' . $key . ' id="q1a1" value=' . $question['a' . $i] . '>';
                echo '<label for="q1a1">' . $question['a' . $i] . '</label><br>';
            }
        }
    }
echo '<button type="submit" name="submit">Отправить</button>';
echo '</form>';

// Проверим на то, что все поля заполнены
// Проверим ответы
$count = [];  // Создадим массив в который запишем количество верных ответов
for ($i = 1; $i < count($_POST) - 1; $i++) {
    if (!empty($_POST['q' . $i]) === true ) {
        if ($_POST['q' . $i] == $jsonData['q' . $i]['r']) {
            array_push($count, $i);
        } else {
            echo 'Ответ на ' . $i . ' вопрос не верный <br>';
        }
    }
}
// Если количество верных ответов совпадает с количеством вопросов, то все верно и выдаем сертификат
if (count($count) == count($_POST) - 2){
    if (!empty($_SESSION['user']['username'])) {
        header('location: http://localhost/certificate.php?username=' . $_SESSION['user']['username']);
    } elseif (!empty($_SESSION['guestName'])) {
        header('location: http://localhost/certificate.php?username=' . $_SESSION['guestName']);
    }
}
?>
