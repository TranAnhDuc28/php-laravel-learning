<?php

class Person
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

$person = new Person();
$person->setName("John Doe");
echo $person->getName();  // Output: John Doe
