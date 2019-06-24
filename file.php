<?php
class hello implements \Countable
{
    public $count = 0;
    use helloTrait;
    use helloTrait2;

    public function getName(int $name, string $lastName)
    {
        echo 'petyya';
    }

    public function getLastName()
    {
        echo 'hi';
    }

    private function setInt(int $int)
    {
        echo "by";
    }

    final public static function setValuesDefault(array $hi, callable $func)
    {
        echo "hello by russia";
    }
}

trait helloTrait{
    public function count()
    {
        echo 'hi';
    }
}


trait helloTrait2{
    public function count3()
    {
        echo 'hi';
    }

    public function count2()
    {
        echo 'hi';
    }
}

