<?php

namespace pointybeard\ShellArgs\Lib;

Class ArgumentIterator implements \Iterator
{
    private $args;
    private $keys;
    private $position = 0;

    public function __construct($ignoreFirst=true, array $argv=NULL)
    {
        // Constructor can accept an array of arguments, 
        // however if it's null, try to use ARGV instead
        if(is_null($argv))
        {
            global $argv;
        }
        
        $start=0;
        if($ignoreFirst == true){
            $start++;
        }
        
        $name = NULL;
        $this->position = 0;
        $this->args = array();
        $this->keys = array();

        // Handle 5 different kinds of params
        for($key = $start; $key < count($argv); $key++) {
            $value = $argv[$key];

            // 1. --zz=something
            if(preg_match('@^--[a-z0-9-_]+=@i', $value)) {
                $bits = explode("=", $value, 2);
                $name = ltrim($bits[0], '--');
                $value = $bits[1];

            // 2. --aa
            } elseif(substr($value, 0, 2) == '--') {
                $name = ltrim($value, '-'); $value = true;

            // 3. -x
            } elseif($value{0} == '-' && isset($argv[$key + 1]) && $argv[$key + 1]{0} == '-') {
                $name = ltrim($value, '-'); $value = true;

            // 4. -y blah
            } elseif($value{0} == '-' && isset($argv[$key + 1]) && $argv[$key + 1]{0} != '-') {
                $name = ltrim($value, '-'); $value = $argv[$key+1];
                $key++;

            // 5. zz=something
            } elseif(preg_match('@^[a-z0-9]([a-z0-9-_]+)?=@i', $value)) {
                $bits = explode("=", $value, 2);
                list($name, $value) = $bits;
            }

            $this->args[] = new Argument($name, $value);
            $this->keys[] = $name;
        }
    }

    public function find($name)
    {
        return (in_array($name, $this->keys) 
                    ? $this->args[array_search($name, $this->keys)] 
                    : false
        );
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->args[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->args[$this->position]);
    }
}