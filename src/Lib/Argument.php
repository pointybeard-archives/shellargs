<?php
namespace pointybeard\ShellArgs\Lib;

Class Argument
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function __get($name)
    {
        if($name != "name" && $name != "value"){ return false; }
        return $this->$name;
    }
}
