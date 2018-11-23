<?php
namespace Car;
//require_once("./Product/Product.class.php");
//use Product;
class Car extends \Product\Product
{
    public $brand = ['subaru', 'bmw'];
    public $model;
    public $color;
    protected $discount;
    public $price;
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
    protected function setAmount($amount)
    {
        // TODO: Implement setAmount() method.
    }
}