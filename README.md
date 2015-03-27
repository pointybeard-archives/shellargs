Shell Arguments
===========

A convenience class for loading arguments passed through the command line ($argv)

## Features

 * Autoloads from `$argv`, or pass in handcrafted array
 * Uses the Iterator base class, but adds `find()` to make looking for, and testing, arguments trival.
 * Support for most common argument formats

## Syntax Supported

`--blah=something`

`-x`

`--aa`

`-y something`

`blah=something`


## Examples

```php
<?php
use pointybeard\ShellArgs\Lib;

// Load up the arguments from $argv. By default
// it will ignore the first item, which is the 
// script name
$args = new ArgumentIterator();

// Instead of using $argv, send in a hand crafted
// array of arguments. e.g. emulates "... -i --database blah"
$args = new ArgumentIterator(false, [
    '-i', '--database', 'blah'
]);

// Iterate over all the arguments
foreach($args as $a){
    printf("%s => %s" . PHP_EOL, $a->name, $a->value);
}

// Find a specific argument by name
$args->find('i');
```