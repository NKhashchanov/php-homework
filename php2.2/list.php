<?php
$filesDir = "./tests";
$filesList = scandir($filesDir);
echo "Выберите тест";
foreach ($filesList as $value) {
    if ($value !='.' and $value !='..' ) {
        echo '<li><a href="test.php?name='. $value.'">'.$value.'</a></li><br>';
    }
}