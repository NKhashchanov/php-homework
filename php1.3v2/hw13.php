<?php
$x = $_GET['x'];
echo "Вы ввели число ".$x."</br>";
$a = 1;
$b = 1;
do {
    if ($x < $a) {
        echo 'Задуманное число НЕ входит в числовой ряд';
        break;
    } else if ($x == $a) {
        echo 'Задуманное число входит в числовой ряд';
        break;
    } else {
        $c = $a;
        $a = $a + $b;
        $b = $c;
        echo 'a=' . $a . '</br>';
    }
}
while(true);
?>






