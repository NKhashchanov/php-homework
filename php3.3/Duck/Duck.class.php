<?php
namespace Duck;
//require_once("./Product/Product.class.php");
//use Product;
class Duck extends \Product\Product
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
    protected function setAmount($amount)
    {
        // TODO: Implement setAmount() method.
    }
}