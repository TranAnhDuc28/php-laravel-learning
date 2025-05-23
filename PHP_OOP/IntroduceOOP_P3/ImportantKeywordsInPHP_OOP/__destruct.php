<?php

class MyClass
{
    private string $name;

    public function __construct()
    {
        echo "Object created.\n";
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __destruct()
    {
        echo "Object destroyed.\n";
    }
}

echo '<pre>';

$object = new MyClass();
$object->setName('DucTV44');

echo $object->getName() . PHP_EOL;