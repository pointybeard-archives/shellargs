<?php
use pointybeard\ShellArgs\Lib\ArgumentIterator;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    // Create iterator using array of argments and check 
    // they have been set correctly.
    public function testValidPassArgsToConstructor()
    {
        $it = new ArgumentIterator(false, [
            '--hithere',
            '-i',
            '-c cheese',
            '--database myDB',
            '-h:local:host'
        ]);

        $this->assertEquals(5, iterator_count($it));
        $this->assertTrue($it->find('hithere')->value);
        $this->assertEquals('cheese', $it->find('c')->value);

        // Since iterator_count() was used, the iterator position should be at the end.
        $this->assertEquals(5, $it->key());

        // Return to start and check the first item is "hithere" with a value of true
        $it->rewind();
        $this->assertEquals(0, $it->key());
        $this->assertEquals('hithere', $it->current()->name);
        $this->assertTrue($it->current()->value);
    }
    
    // Set the "ignoreFirst" property to true and check that
    // the first item (file name) has been ignored
    public function testValidIgnoreFirstArg()
    {
        $it = new ArgumentIterator(true, [
            '../blah/blah',
            '--hithere',
        ]);
        $this->assertEquals(1, iterator_count($it));
        $this->assertFalse($it->find('../blah/blah'));
    }

    // Seed the global $argv array with some data
    public function testValidARGV()
    {
        // Seed the $argv array
        global $argv;
        $argv = [
            '../blah/blah',
            '--hithere',
            '-i',
            '-c',
            'cheese',
            '-p:\Users\pointybeard\Sites\shellargs\\'
        ];

        $it = new ArgumentIterator();
        $this->assertEquals(4, iterator_count($it));
        $this->assertTrue($it->find('hithere')->value);
        $this->assertEquals('\Users\pointybeard\Sites\shellargs\\', $it->find('p')->value);
    }

    // Give a argument string to the constructor
    public function testValidArgString()
    {
        $it = new ArgumentIterator(false, ['--hithere -i -c cheese']);
        $this->assertEquals(3, iterator_count($it));
    }
}
