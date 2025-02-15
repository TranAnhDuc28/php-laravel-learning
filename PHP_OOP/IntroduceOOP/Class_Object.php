<?php

echo '<pre>';
class Car
{
    public $brand;
    public $color;

    public function drive()
    {
        echo "Driving $this->brand car" . PHP_EOL;
    }
}

$myCar1 = new Car();
$myCar1->brand = "Toyota";
$myCar1->color = "White";
$myCar1->drive(); // print myCar1

$myCar1 = new Car();
$myCar1->brand = "Mec";
$myCar1->color = "Black";
$myCar1->drive(); // print myCar2