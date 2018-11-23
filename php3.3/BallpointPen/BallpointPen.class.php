<?php
namespace BallpointPen;
//require_once("./Product/Product.class.php");
//use Product;
class BallpointPen extends \Product\Product
{
    public $brand = 'Bic';
    public $price;
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
    protected function setAmount($amount)
    {
        // TODO: Implement setAmount() method.
    }
}