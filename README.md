# Shell Arguments for PHP CLI

- Version: v1.0.4
- Date: October 17th 2018
- [Release notes](https://github.com/pointybeard/shellargs/blob/master/CHANGELOG.md)
- [GitHub repository](https://github.com/pointybeard/shellargs)

[![Latest Stable Version](https://poser.pugx.org/pointybeard/shell-args/v/stable)](https://packagist.org/packages/pointybeard/shell-args) [![Total Downloads](https://poser.pugx.org/pointybeard/shell-args/downloads)](https://packagist.org/packages/pointybeard/shell-args) [![Latest Unstable Version](https://poser.pugx.org/pointybeard/shell-args/v/unstable)](https://packagist.org/packages/pointybeard/shell-args) [![License](https://poser.pugx.org/pointybeard/shell-args/license)](https://packagist.org/packages/pointybeard/shell-args)

A convenience class for loading arguments passed through the command line (`$argv`)

* Autoloads from `$argv`, or pass in handcrafted array
* Uses the Iterator base class, but adds `find()` to make looking for, and testing, arguments trivial.
* Support for most common argument formats

## Installation

Shell Arguments for PHP CLI is installed via [Composer](http://getcomposer.org/). To install, use `composer require pointybeard/shell-args` or add `"pointybeard/shell-args": "~1.0"` to your `composer.json` file.

## Usage

Include `pointybeard\ShellArgs\Lib` in your scripts then create an instance of `ArgumentIterator`. It will automatically look for arguments, or you can pass it your own argument string (see below).

### Syntax Supported

This library supports the most common argument formats. Specifically `-x`,` --long`, `/x`. It also supports use of `=` or `:` as a delimiter. The following are examples of supported argument syntax:

    -x
    --aa
    --database=blah
    -d:blah
    --d blah
    --database-name=blah
    /d blah
    -u http://www.theproject.com
    -y something
    -p:\Users\pointybeard\Sites\shellargs\
    -p:"\Users\pointybeard\Sites"
    -h:local:host
    /host=local-host

### Examples

```php
<?php
use pointybeard\ShellArgs\Lib;

// Load up the arguments from $argv. By default
// it will ignore the first item, which is the
// script name
$args = new ArgumentIterator();

// Instead of using $argv, send in an array
// of arguments. e.g. emulates "... -i --database blah"
$args = new ArgumentIterator(false, [
    '-i', '--database', 'blah'
]);

// Arguments can an entire string too [Added 1.0.1]
$args = new ArgumentIterator(false, [
    '-i --database blah'
]);

// Iterate over all the arguments
foreach($args as $a){
    printf("%s => %s" . PHP_EOL, $a->name(), $a->value());
}

// Find a specific argument by name
$args->find('i');

// Find also accepts an array of values, returning the first one that is valid
$args->find(['h', 'help', 'usage']);
```

## Running the Test Suite

You can check that all code is passing by running the following command from the shell-args folder:

    ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ArgumentsTest
    
If you want to run code coverage (e.g. `--coverage-html tests/reports/ ...`) you'll need an older version of xdebug (for PHP 5.6). To install this, use the following commands:

    pecl channel-update pecl.php.net
    pecl install xdebug-2.5.5
    
You'll need enable `xdebug.so`. Try adding the following to `/etc/php/5.6/mods-available`

    ; configuration for php xdebug module
    ; priority=20
    zend_extension=/usr/lib/php/20131226/xdebug.so 

Then enable it with `phpenmod xdebug`. The above works on Ubuntu, however, paths might be different for other distros.

## Support

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pointybeard/cron/issues),
or better yet, fork the library and submit a pull request.

## Contributing

We encourage you to contribute to this project. Please check out the [Contributing documentation](https://github.com/pointybeard/cron/blob/master/CONTRIBUTING.md) for guidelines about how to get involved.

## License

"Shell Arguments for PHP CLI" is released under the [MIT License](http://www.opensource.org/licenses/MIT).
