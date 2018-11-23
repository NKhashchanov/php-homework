<?php
namespace Product;
abstract class Product
{
    public $price;
    private $discount;
    private $amount;
    public $name;
    abstract protected function setAmount($amount);
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