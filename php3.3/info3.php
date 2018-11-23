<?php

function carLoad($class)
{
    $filePath = __DIR__. '/Car/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }
}
spl_autoload_register('carLoad');


$japan = new Car();
$europe = new Car();
foreach ($japan->brand as $value) {
    if ($value == 'subaru') {
        $japan->setPrice(1000);
        echo '<br>' . $japan->whatPrice();
    } else {
        $europe->setPrice(10);
        echo '<br>' . $europe->whatPrice();
    }
}
class JapanWholesale extends Car
{
    public $amount = 10;
    public function Wholesale() {
        return $this->setPrice(1000) * $this->amount;
    }
}
$totalCost = new JapanWholesale();
echo '<br>Оптовая партия в количестве ' . $totalCost->amount . ' штук стоит ' . $totalCost->Wholesale() . '<br>';
interface EuropeCars
{
    public function destroyCars($model);
}



function TVLoad($class)
{
    $filePath = __DIR__. '/TV/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }
}
spl_autoload_register('TV\TVLoad');

$addDiagonal = new TV();
for ($i = 0; $i < 10; $i++) {
    $x = 27 + $i;
    array_push($addDiagonal->diagonal,($x));
    echo '<br> Диагональ: ' . $addDiagonal->diagonal[$i];
}
$newDiag = new TV();
echo '<br>Новые диагонали: ' . $newDiag->newDiagonal(20);
interface howManyDiagonals
{
    public function summDiagonals($summDiag);
}
interface Types
{
    public function selectType($type);
}
class NewTV extends TV implements Types
{
    public function selectType($type)
    {
        echo 'Выберите тип: должна быть форма вывода, но лень вещь такая :)';
    }
}


function duckLoad($class)
{
    $filePath = __DIR__. '/Duck/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }
}
spl_autoload_register('Duck\duckLoad');

interface DonaldDuck
{
    public function Cartoon($type);
}
interface ChangeColor
{
    public function changeColor($color);
}
interface ManyIntDuck extends DonaldDuck, ChangeColor
{
    public function classDuck($newClass);
}

$eatDuck = new Duck();
$eatDuck->eatOrNotEat(true);
$duckColor = new Duck();
echo $duckColor->setColor('red');


function productLoad($class)
{
    $filePath = __DIR__. '/Product/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }
}
spl_autoload_register('Product\productLoad');

interface NewProduct
{
}
interface OldProduct
{
}
interface AnotherProduct
{
}
interface OneMoreProduct extends NewProduct, OldProduct, AnotherProduct
{
}


function ballpointPenLoad($class)
{
    $filePath = __DIR__. '/BallpointPen/' . str_replace('\\', '/', $class) . '.class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }
}
spl_autoload_register('BallpointPen\ballpointPenLoad');

$penColor = new BallpointPen();
echo "<br> Цвет ручки: " . $penColor->randomColor();
$whatPen = new BallpointPen();
echo '<br> Производитель: ' . $whatPen->brand;
interface ChangeBrands
{
    public function ChangeBrand($brand);
}
interface AddPropertie
{
    public function addPropertie($proper);
}
class NewPen extends BallpointPen implements AddPropertie
{
    public function addPropertie($proper)
    {
        parent::__construct($proper);
    }
}


class Cart
{
    public $product;
    public $discount;
    public $totalProduct = [];
    public function addProduct($product){
        $product->numberProduct = 1;
        if(array_key_exists($product->name, $this->totalProduct)){
            $this->totalProduct[$product->name]->numberProduct++;
            echo 'Товар добавлен в корзину<br>';
        } else {
            $this->totalProduct[$product->title] = $product;
        }
    }
    public function deleteProduct($product){
        if(array_key_exists($product->name, $this->totalProduct)){
            if($this->totalProduct[$product->name]->numberProduct > 0){
                $this->totalProduct[$product->name]->numberProduct--;
                echo 'Товар ' . $this->totalProduct[$product->name]->name. ' удалён из корзины<br>';
            }
        }
    }
    public function summ(){
        $res = 0;
        foreach($this->totalProduct as $key => $value){
            $res = $res + ($value->price * $value->numberProduct);
        }
        return $res;
    }
}
class Order extends Cart
{
    public function resSum() {
        if ($this->summ() > 0) {
            echo 'Сумма заказа: ' . $this->summ();
        }
    }
}
echo <<<HTML
Пространство имен это структура и иерархия в пространстве имен, которое необходимо для предотвращения возникновения ошибок<br>
связанных с дублированием имен различных элементов скрипта.<br>
Эксепшены это инструмент для создания и обработки ошибок. Так же можно использовать для упрощения логики и архитектуры кода.<br>
HTML;

class News
{
    private $title;
    private $date;
    private $body;
    public function __construct($title, $date, $body)
    {
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getBody()
    {
        return $this->body;
    }
}
$news = new News('1f', '2hjkhjk', '3ghjghjg');
echo <<<HTML
<br>
<table>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>{$news->getTitle()}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$news->getDate()}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$news->getBody()}</td>
    </tr>
</table>
HTML;


/*
$bike = new Product();
$bike->name = 'Велосипед';
$scooter = new Product();
$scooter->name = 'Самокат';
*/
echo <<<HTML
<br>
<table>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>Наименование</td>
        <td style = 'width: 100px; border: gray solid 1px'>Цена</td>
        <td style = 'width: 100px; border: gray solid 1px'>Количество</td>
        <td style = 'width: 100px; border: gray solid 1px'>Скидка</td>
    </tr>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>{$bike->name}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$bike->setPrice(1000)}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$bike->setAmount(10)}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$bike->setDiscount(15)}</td>
    </tr>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>{$scooter->name}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$scooter->setPrice(600)}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$scooter->setAmount(3)}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$scooter->setDiscount(10)}</td>
    </tr>
</table>
HTML;
// Здесь напишем суперкласс
$prCar = new Car();
$q = $prCar->howManyProperties(5);
$prTV = new TV();
$w = $prTV->howManyProperties(5);
$prBallpointPen = new BallpointPen();
$e = $prBallpointPen->howManyProperties(2);
$prDuck = new Duck();
$r = $prDuck->howManyProperties(2);
class Properties
{
    public function howManyProperties($prop) {
        $propert = [];
        array_push($propert, $prop);
        return $propert;
    }
}
$summ = 0;
for ($i = 0; $i < count($q); $i++) {
    $summ += $q[$i] +  $w[$i] + $e[$i] + $r[$i] + $t[$i];
}
echo <<<HTML
<br>
Сколько свойств в наших классах
<table>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>Car</td>
        <td style = 'width: 100px; border: gray solid 1px'>TV</td>
        <td style = 'width: 100px; border: gray solid 1px'>BallpointPen</td>
        <td style = 'width: 100px; border: gray solid 1px'>Duck</td>
        <td style = 'width: 100px; border: gray solid 1px'>Product</td>
    </tr>
    <tr>
        <td style = 'width: 100px; border: gray solid 1px'>{$q[0]}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$w[0]}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$e[0]}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$r[0]}</td>
        <td style = 'width: 100px; border: gray solid 1px'>{$t[0]}</td>
    </tr>
</table>
<br>
а всего: {$summ}
HTML;
?>