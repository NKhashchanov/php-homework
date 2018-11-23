
1. Распишите своё понимание инкапсуляции. Представьте, что вас спрашивают на собеседовании.<br>
2. Сформулируйте своими словами в чём плюсы объектов, а в чём минусы?<br>
3. Опишите 5 классов и создайте по 2 объекта каждого класса — Машина, Телевизор, Шариковая ручка, Утка, Товар.<br>
Классы должны содержать свойства и методы. Все в одном файле.<br>

Инкапсуляция - это механизм, который заключает и объединяет в себе данные и методы, ограничивая к ним доступ.<br>
Тем самым инкапсуляция позволяет разделить компоненты кода, обезопасить влияние одних элементов на другие, назначать "права доступа".<br>
Плюсы: Объекты позволяют структурировать данные, тем самым упрощая манипуляции с группами данных. К примеру для хранения данных<br>
мы используем структурированные базы данных. Классы, объекты и ООП в целом позволяют нам так же структурировать и апеллировать<br>
кодом и его элементами.<br>
Минусы: Для новичков сложно понять абстрактные типы данных, программирование наука точная! Наверно к минусам можно отнести только<br>
необходимость изучения громадного количества информации и получение громадного опыта в проектировании и конструировании классов.<br>
Как сказал один человек - ООП это "виртуальный" язык программирования.<br>


<?php

class Car
{
    public $brand = ['subaru', 'bmw'];
    public $model;
    public $color;
    protected $discount;
    private $price;
    public function whatPrice() {
        return $this->price;
    }
    public function setPrice($price)
    {
        return $this->price = $price;
    }
}
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

class TV
{
    public $brand;
    public $model;
    public $diagonal = [10, 15, 20];
    public $type;
    private $price;

    public function newDiagonal($diagonal) {
        $newDiagonal = $diagonal * 2;
        return $newDiagonal;
    }
}
$addDiagonal = new TV();
for ($i = 0; $i < 10; $i++) {
    $x = 27 + $i;
    array_push($addDiagonal->diagonal,($x));
    echo '<br> Диагональ: ' . $addDiagonal->diagonal[$i];
}
$newDiag = new TV();

echo '<br>Новые диагонали: ' . $newDiag->newDiagonal(20);

class BallpointPen
{
    public $brand = 'Bic';
    private $price;
    public function randomColor() {
        $x = rand(0, 255);
        $y = rand(0, 255);
        $z = rand(0, 255);
        return $result = 'R' . "$x" . ', G' . "$y" . ', B' . "$y";
    }
}
$penColor = new BallpointPen();
echo "<br> Цвет ручки: " . $penColor->randomColor();
$whatPen = new BallpointPen();
echo '<br> Производитель: ' . $whatPen->brand;

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

class Duck
{
    public $type;
    public $color;

    public function eatOrNotEat($bool){
        if ($bool === true) {
            echo 'Мы съели утку!<br>';
        } else {
            echo 'Утка будет жить';
        }
    }

    public function setColor($color)
    {
       return $this->color = $color;
    }
}

$eatDuck = new Duck();
$eatDuck->eatOrNotEat(true);

$duckColor = new Duck();
echo $duckColor->setColor('red');

class Product
{
    private $price;
    private $discount;
    private $amount;
    public $name;

    public function setAmount($amount)
    {
       return $this->amount = $amount;
    }

    public function setDiscount($discount)
    {
       return $this->discount = $discount;
    }

    public function setPrice($price)
    {
       return $this->price = $price;
    }
}

$bike = new Product();
$bike->name = 'Велосипед';

$scooter = new Product();
$scooter->name = 'Самокат';

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



?>
