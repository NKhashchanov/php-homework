<style>
    ui {
        display: flex;
    }
    li {
        list-style-type: none;
        width: 70px;
    }
</style>
<?php
$x = $_GET['x'];
echo "Вы ввели число ".$x."";
$a = 1;
$b = 1;
if ($a > $x) {
    echo 'Задуманное число НЕ входит в числовой ряд';
} elseif ($a == $x) {
    echo 'Задуманное число входит в числовой ряд';
} else {
     while($x > $a){
    $c = $a;
    $a = $a + $b;
    $b = $c;
    echo '<ui><li>a='.$a.'</li><li>b='.$b.'</li><li>c='.$c.'</li></ui>';}
};
?>
