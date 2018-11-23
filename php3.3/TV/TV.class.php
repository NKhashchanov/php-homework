<?php
namespace TV;
//require_once("./Product/Product.class.php");
//use Product;
class TV extends \Product\Product
{
    public $brand;
    public $model;
    public $diagonal = [10, 15, 20];
    public $type;
    public $price;
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
    protected function setAmount($amount)
    {
        // TODO: Implement setAmount() method.
    }
}