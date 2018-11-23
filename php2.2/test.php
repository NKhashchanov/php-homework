<?php
// Проверим на не пустой GET
if ($_GET["name"] == null) die('<a href = "./list.php">Выберите тест</a>');
// Проверим, что запрос соответствует тесту на сервере
$filesDir = "./tests";
$filesList = scandir($filesDir);
if (!in_array($_GET["name"], $filesList)) {
    http_response_code(404);
    echo 'Cтраница не найдена!';
    exit(1);
}
//Прочитаем JSON тест
$fileName = $_GET["name"];
$json = file_get_contents("./tests/$fileName");
$jsonData = json_decode($json, true);

// Выведем тест
if (!empty($jsonData)) {
echo 'Название теста: ' . $jsonData['label'] . '<br>';
echo '<form method="POST" action="">';
foreach ($jsonData as $key => $questions) {
    if ($key !== 'label') {
        echo $questions['q'] . '<br>';
        foreach ($questions['question'] as $question) {
           echo '<input required type="radio" name=' . $key . ' value=' . $question . '>';
              echo '<label>' . $question . '</label><br>';
        }
    }
}
echo '<input type="text" required name="userName" placeholder="Введите Ваше имя">';
echo '<button type="submit" name="submit">Отправить</button>';
echo '</form>';
} else {
    echo 'тест пустой, вернитесь к списку тестов <br>';
    echo '<a href = "list.php">Список тестов</a>';
}
// Проверим на то, что все поля заполнены
// Проверим ответы
$answers = [];  // Создадим массив в который запишем варианты ответов пользователя
if (!empty($_POST)) {
    foreach ($_POST as $value) {
        array_push($answers, $value);
    }
}

$correctAnswers = []; // Создадим массив в который запишем правильные варианты ответов
foreach ($jsonData as $key => $questions) {
    if ($key !== 'label') {
        array_push($correctAnswers, $questions['r']);
    }
}

$result = [];   // Создадим массив в который запишем количество верных вариантов ответа
for ($i = 0; $i < count($_POST) - 2; $i++) {
    if ($answers[$i] === $correctAnswers[$i]) {
        array_push($result, $i);
    } else {
        $x = $i +1;
        echo 'Ответ на ' . $x . ' вопрос не верный <br>';
    }
}

// Если количество верных ответов совпадает с количеством вопросов, то все верно и выдаем сертификат
if (count($result) == count($_POST) - 2){
    header('location: certificate.php?username=' . $_POST['userName']);
}
?>
