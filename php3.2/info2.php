Наследование - это механизм, позволяющий описать новый класс на основе уже существующего, при этом свойства и методы<br>
заимствуются у родительского класса<br>.
Полиморфизм - это взаимозаменяемость объектов с одинаковым классом или интерфейсом. При этом все методы интерфейса<br>
будут вести себя так как нужно, независимо от того, какой конкретно производный класс используется<br>
Интерфейсы имеют лишь перечень публичных методов без их реализации, абстрактные же классы имеют реализацию методов и как минимум<br>
один нереализованный метод.<br>
Нельзя создавать экземпляры абстрактоного класса, можно скрывать реализацию.<br>

<?php
class Car extends Properties implements EuropeCars
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
    public function howManyProperties($prop)
    {
        return parent::howManyProperties($prop);
    }
    public function destroyCars($model)
    {
        foreach ($this->brand as $key => $value) {
            if ($value === 'bmw') {
                unset($this->brand[$key]);
            }
        }
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

class TV extends Properties implements howManyDiagonals
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
    public function howManyProperties($prop)
    {
        return parent::howManyProperties($prop);
    }
    public function summDiagonals($summDiag)
    {
        $sd = 0;
        foreach ($this->diagonal as $diag) {
            $sd += $diag;
        }
        return $sd;
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

class BallpointPen extends Properties implements ChangeBrands
{
    public $brand = 'Bic';
    private $price;
    public function randomColor() {
        $x = rand(0, 255);
        $y = rand(0, 255);
        $z = rand(0, 255);
        return $result = 'R' . "$x" . ', G' . "$y" . ', B' . "$y";
    }
    public function howManyProperties($prop)
    {
        return parent::howManyProperties($prop);
    }
    public function ChangeBrand($brand)
    {
        $this->brand = 'Завод №17';
    }
}
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

class Duck extends Properties implements ManyIntDuck
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
    public function howManyProperties($prop)
    {
        return parent::howManyProperties($prop);
    }
    public function Cartoon($type)
    {
        function someName(){
            if ($this->type === 'Donald'){
                echo 'Не стоит есть мультяшную утку!';
            } else {
                echo 'приятного аппетита';
            }
        }
    }
    public function changeColor($color)
    {
        parent::__construct($color);
    }
    public function classDuck($newClass)
    {
        // TODO: Implement classDuck() method.
    }
}
$eatDuck = new Duck();
$eatDuck->eatOrNotEat(true);
$duckColor = new Duck();
echo $duckColor->setColor('red');

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

class Product extends Properties implements OneMoreProduct
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
    public function howManyProperties($prop)
    {
        return parent::howManyProperties($prop);
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

// Здесь напишем суперкласс

$prCar = new Car();
$q = $prCar->howManyProperties(5);

$prTV = new TV();
$w = $prTV->howManyProperties(5);

$prBallpointPen = new BallpointPen();
$e = $prBallpointPen->howManyProperties(2);

$prDuck = new Duck();
$r = $prDuck->howManyProperties(2);

$prProduct = new Product();
$t = $prProduct->howManyProperties(4);

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

