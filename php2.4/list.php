<?php
require_once __DIR__ . '/functions.php';
if (isAdmin()) {
    echo '<a href = "http://localhost/admin.php">Добавить тест</a><br>';
}

$filesDir = "./tests";
$filesList = scandir($filesDir);
echo "Выберите тест";
foreach ($filesList as $value) {
    if ($value !='.' and $value !='..' ) {
        echo '<li><a href="test.php?name='. $value.'">'.$value.'</a></li><br>';
    }
}

if (isAuthorized()) {
    echo '<form method="POST" action="">';
    echo '<select class="form-control" name="tests">';
    echo '<option value=""></option>';
    foreach ($filesList as $test){
        if ($test !='.' and $test !='..' ) {
            echo '<option value=' . $test . '>' . $test . '</option>';
        }
    }
    echo '<input type="submit" value="удалить"><br>';
    echo '</form>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_POST) === true) {
        deleteTest($test);
    }
}



echo '<a href="logout.php">Выход</a>';