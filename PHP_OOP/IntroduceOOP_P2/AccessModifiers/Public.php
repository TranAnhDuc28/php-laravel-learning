<?php

class Car
{
    public $brandS = "Toyota";

    public function showBrand()
    {
        echo $this->brandS;
    }
}

class Mec extends Car
{
    public function abc()
    {
        $this->brandS;
    }
}

$car = new Car();
$car->showBrand();  // Output: Toyota
