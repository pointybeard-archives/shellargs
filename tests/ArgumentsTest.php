<?php
use pointybeard\ShellArgs\Lib\ArgumentIterator;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    // Create iterator using array of argments and check 
    // they have been set correctly.
    public function testValidPassArgsToConstructor()
    {
        $it = new ArgumentIterator(false, [
            '../blah/blah',
            '--hithere',
            '-i',
            '-c',
            'cheese'
        ]);

        $this->assertEquals(4, iterator_count($it));
        $this->assertEquals('cheese', $it->find('c')->value);
        $this->assertTrue($it->find('hithere')->value);
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
}
